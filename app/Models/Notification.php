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

	const TYPE_NEW_LETTER          = 1;
	const TYPE_NEW_PRODUCT_REVIEW  = 2;
	const TYPE_NEW_PRODUCT_COMMENT = 3;
	const TYPE_NEW_REQUESTED_CALL  = 4;
	const TYPE_NEW_ORDER           = 5;

	public static $notificationsTitle = [
		self::TYPE_NEW_LETTER          => 'Новое письмо',
		self::TYPE_NEW_PRODUCT_REVIEW  => 'Новый отзыв о товаре',
		self::TYPE_NEW_PRODUCT_COMMENT => 'Новый комментарий к товару',
		self::TYPE_NEW_REQUESTED_CALL  => 'Заказ звонка',
		self::TYPE_NEW_ORDER           => 'Новый заказ',
	];

	public static $messagesTemplates = [
		self::TYPE_NEW_LETTER          => '<p>Пришло новое <a href="[linkToLetter]">письмо</a> от [letterFromName] ([letterFromEmail]).<br>Тема: "[letterSubject]".</p> <p class="notify-hidden"><a href="[linkToLetter]" class="pull-right m-t-10">Прочесть <i class="fa fa-arrow-right"></i></a></p>',
		self::TYPE_NEW_PRODUCT_REVIEW  => '<p>[user] добавил новый <a href="[linkToReview]">отзыв</a> к товару <a href="[linkToPage]">"[pageTitle]"</a>.</p> <p class="notify-hidden"><a href="[linkToReview]" class="pull-right m-t-10">Редактировать <i class="fa fa-arrow-right"></i></a></p>',
		self::TYPE_NEW_PRODUCT_COMMENT => '<p>[user] добавил новый <a href="[linkToReview]">комментарий</a> к товару <a href="[linkToPage]">"[pageTitle]"</a>.</p> <p class="notify-hidden"><a href="[linkToReview]" class="pull-right m-t-10">Редактировать <i class="fa fa-arrow-right"></i></a></p>',
		self::TYPE_NEW_REQUESTED_CALL  => '<p><a href="[linkToCall]">[userName] просит перезвонить</a>.</p>',
		self::TYPE_NEW_ORDER           => '<p>Добавлен новый <a href="[linkToOrder]">заказ</a> на сумму [totalPrice]</a>.</p>',
	];

	public static $icons = [
		self::TYPE_NEW_LETTER          => 'fa fa-envelope',
		self::TYPE_NEW_PRODUCT_REVIEW  => 'fa fa-comments',
		self::TYPE_NEW_PRODUCT_COMMENT => 'fa fa-comments',
		self::TYPE_NEW_REQUESTED_CALL  => 'fa fa-phone',
		self::TYPE_NEW_ORDER           => 'fa fa-shopping-cart',
	];

	public static $classes = [
		self::TYPE_NEW_LETTER          => 'bg-warning',
		self::TYPE_NEW_PRODUCT_REVIEW  => 'bg-pink',
		self::TYPE_NEW_PRODUCT_COMMENT => 'bg-pink',
		self::TYPE_NEW_REQUESTED_CALL  => 'bg-info',
		self::TYPE_NEW_ORDER           => 'bg-success',
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
				Notification::create([
					'user_id' => $userModel->id,
					'type'    => $notificationType,
					'message' => $notificationMessage,
				]);

				if(self::TYPE_NEW_LETTER == $notificationType) {
					$notificationMessage = $notificationMessage . '<br><h3>Текст письма:</h3><p>' . $variables['[letterText]'] . '</p>';
				}

				\Mail::send('layouts.email', ['content' => $notificationMessage, 'variables' => $variables, 'userModel' => $userModel], function($message) use ($userModel, $emailSubject)
				{
					$message->to($userModel->email, $userModel->login)
						->subject($emailSubject);
				});
				\Log::info("Email with notification for [{$userModel->login}] successfully sent. Notfication: [{$notificationMessage}]");
			}
		}
	}

	/**
	 * New notification for all users (admin and manager)
	 *
	 * @param $notificationType
	 * @param array $variables
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function forAllUsers($notificationType, $variables = [])
	{
		$users = User::whereIn('role', [User::ROLE_ADMIN, User::ROLE_MANAGER])
			->whereIsActive(1)
			->with('settings')
			->get();

		foreach ($users as $user) {
			$user->setNotification($notificationType, $variables);
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