<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
	protected $table = 'notifications';

	const TYPE_NEW_LETTER         = 1;
	const TYPE_NEW_PRODUCT_REVIEW = 2;
	const TYPE_NEW_PRODUCT_COMMENT = 3;
	const TYPE_NEW_REQUESTED_CALL = 4;
	const TYPE_NEW_ORDER          = 5;

	public static $messagesTemplates = [
		self::TYPE_NEW_LETTER          => 'Пришло новое <a href="[linkToLetter]">письмо</a> от [letterFromName] ([letterFromEmail]). Тема: "[letterSubject]".',
		self::TYPE_NEW_PRODUCT_REVIEW  => 'Добавлен новый <a href="[linkToReview]">отзыв</a> к товару <a href="[linkToPage]">"[pageTitle]"</a>.',
		self::TYPE_NEW_PRODUCT_COMMENT => 'Добавлен новый <a href="[linkToReview]">комментарий</a> к товару <a href="[linkToPage]">"[pageTitle]"</a>.',
		self::TYPE_NEW_REQUESTED_CALL  => '<a href="[linkToCall]">[userName] просит перезвонить</a>.',
		self::TYPE_NEW_ORDER           => 'Добавлен новый <a href="[linkToOrder]">заказ</a> на сумму [totalPrice]</a>. Статус: [status]',
	];

	public static $notificationSettingColumns = [
		self::TYPE_NEW_LETTER          => ['permission_letters'],
		self::TYPE_NEW_PRODUCT_REVIEW  => ['permission_products_reviews'],
		self::TYPE_NEW_PRODUCT_COMMENT => ['permission_products_reviews'],
		self::TYPE_NEW_REQUESTED_CALL  => ['permission_requested_calls'],
		self::TYPE_NEW_ORDER           => ['permission_orders'],
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'type',
		'message',
	];

	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static $rules = [
		'user_id' => 'required|integer',
		'type' => 'required|integer',
		'message' => 'required|max:250',
	];

	/**
	 * Get validation rules
	 *
	 * @param bool $id
	 * @return array
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function rules($id = false)
	{
		$rules = self::$rules;
		if ($id) {
			foreach ($rules as &$rule) {
				$rule = str_replace(':id', $id, $rule);
			}
		}
		return $rules;
	}

	/**
	 * Получатель уведомления
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function user()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}

	/**
	 * Add new notification
	 *
	 * @param $userModel
	 * @param $notificationType
	 * @param array $variables
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function add($userModel, $notificationType, $variables = [])
	{
		$settingsColumns = Notification::$notificationSettingColumns[$notificationType];
		if(is_object($userModel->settings)) {
			foreach($settingsColumns as $column) {
				$sendMessage = $userModel->settings->$column;
				if($sendMessage) {
					break;
				}
			}
		} else {
			$sendMessage = true;
		}

		if($sendMessage) {
			$variables['[siteUrl]'] = \Config::get('app.url');
			$variables['[siteName]'] = \Config::get('mail.from.name');

			$notificationMessage = $this->getMessage($notificationType, $variables);
			$emailSubject = $this->getEmailSubject($variables);

			if($notificationMessage) {
				\Mail::send('layouts.email', ['content' => $notificationMessage, 'variables' => $variables, 'userModel' => $userModel], function($message) use ($userModel, $emailSubject)
				{
					$message->to($userModel->email, $userModel->login)
						->subject($emailSubject);
				});
				\Log::info("Email with notification for [{$userModel->login}] successfully sent. Notfication: [{$notificationMessage}]");

				Notification::create([
					'user_id' => $userModel->id,
					'type'    => $notificationType,
					'message' => $notificationMessage,
				]);
			}
		}
	}

	private function getEmailSubject($variables)
	{
		return 'Уведомление с сайта ' . $variables['[siteName]'] . '.';
	}

	private function getMessage($notificationType, $variables)
	{
		if(isset(self::$messagesTemplates[$notificationType])) {
			return strtr(self::$messagesTemplates[$notificationType], $variables);
		} else return false;
	}
}