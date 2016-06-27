<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use App\Helpers\Str;
use App\Helpers\Translit;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

/**
 * App\Models\User
 *
 * @property integer $id
 * @property string $login
 * @property string $email
 * @property string $password
 * @property boolean $role
 * @property string $firstname
 * @property string $lastname
 * @property string $description
 * @property string $phone
 * @property string $avatar
 * @property boolean $is_active
 * @property string $activation_code
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RequestedCall[] $requestedCalls
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductReview[] $comments
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereLogin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRole($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereFirstname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereLastname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereIsActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereActivationCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
	protected $table = 'users';

	protected $imagePath = '/uploads/users/';

	/**
	 * Роль пользователя (значение поля role)
	 */
	const ROLE_NONE    = 0;
	const ROLE_ADMIN   = 1;
	const ROLE_MANAGER = 2;
	const ROLE_USER    = 3;

	public static $roles = [
		self::ROLE_NONE    => '-',
		self::ROLE_ADMIN   => 'Администратор',
		self::ROLE_MANAGER => 'Менеджер',
//		self::ROLE_USER    => 'Пользователь',
	];
	
	public static $rolesClass = [
		self::ROLE_NONE    => 'empty',
		self::ROLE_ADMIN   => 'success',
		self::ROLE_MANAGER => 'info',
//		self::ROLE_USER    => 'primary',
	];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
	    'login',
	    'email',
	    'password',
	    'role',
	    'firstname',
	    'lastname',
	    'description',
	    'phone',
	    'avatar',
    ];

	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected static $rules = [
		'login' => 'required|unique:users,login,:id|max:50|regex:/^[A-Za-z0-9\-\_]+$/u',
		'email' => 'required|email|max:255',
		'password' => 'required|min:6|max:255|confirmed',
		'role' => 'integer',
		'firstname' => 'max:50|regex:/^[A-Za-zА-Яа-яЁёЇїІіЄє \-\']+$/u',
		'lastname' => 'max:50|regex:/^[A-Za-zА-Яа-яЁёЇїІіЄє \-\']+$/u',
		'phone' => 'max:50|regex:/^[0-9]+$/u',
		'avatar' => 'image|max:3072',
		'description' => 'max:1000',
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

	public static function boot()
	{
		parent::boot();

		// доделать редактирование удаленных пользователей
		static::saving(function($user) {
			if($user->id !== 1 && $user->role != self::ROLE_NONE) {
				$user->is_active = 1;
			}
		});

		// доделать вход только активных пользователей, неавтивный пользователь - удаленный пользователь
		static::deleting(function($user) {
			$user->notifications()->delete();
			$user->settings()->delete();

			if(count($user->orders) || count($user->requestedCalls) || count($user->comments)) {
				$user->is_active = 0;
				return false;
			}
		});
	}

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'activation_code',
    ];

	/**
	 * Принятые заказы
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function orders()
	{
		return $this->hasMany('App\Models\Order', 'user_id');
	}

	/**
	 * Принятые звонки
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function requestedCalls()
	{
		return $this->hasMany('App\Models\RequestedCall', 'user_id');
	}

	/**
	 * Комментарии
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function comments()
	{
		return $this->hasMany('App\Models\ProductReview', 'user_id');
	}

	/**
	 * Уведомления пользователя
	 *
	 * @return mixed
	 */
	public function notifications()
	{
		return $this->hasMany('App\Models\Notification', 'user_id')->orderBy('created_at', 'DESC');
	}

	/**
	 * Настройки аккаунта пользователя
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function settings()
	{
		return $this->hasOne('App\Models\UserSetting', 'user_id');
	}

	/**
	 * Get user's avatar path
	 *
	 * @param bool $default
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getAvatarUrl($default = true) {
		return $this->avatar
			? url($this->imagePath . $this->id . '/' . $this->avatar)
			: ($default
				? url('images/default-avatar.jpg')
				: '');
	}

	/**
	 * @param $user
	 * @return bool
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function is($user)
	{
		return $this->id == $user->id ? true : false;
	}

	public function isAdmin()
	{
		return $this->role == self::ROLE_ADMIN ? true : false;
	}

	public function getFullName() {
		return $this->firstname . ' ' . $this->lastname;
	}

	/**
	 * @return mixed
	 */
	public function getPhone()
	{
		return Str::phoneFormat($this->phone);
	}
	
	/**
	 * Image uploading
	 *
	 * @param Request $request
	 * @return bool
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function setImage(Request $request)
	{
		$postImage = $request->file('avatar');
		if (isset($postImage)) {
			$fileName = Translit::generateFileName($postImage->getClientOriginalName());
			$imagePath = public_path() . $this->imagePath . $this->id . '/';
			$image = Image::make($postImage->getRealPath());
			File::exists($imagePath) or File::makeDirectory($imagePath, 0755, true);
			
			// delete old image
			$this->deleteImage();
			
			$image->save($imagePath . 'origin_'. $fileName);

			$cropSize = ($image->width() < $image->height()) ? $image->width() : $image->height();
			$image->crop($cropSize, $cropSize)
				->resize(128, null, function ($constraint) {
					$constraint->aspectRatio();
				})->save($imagePath . $fileName);
			
			$this->avatar = $fileName;
			return true;
		} else {
			if($request->get('deleteImage')) {
				$this->deleteImage();
				return true;
			}
			return false;
		}
	}
	
	/**
	 * Delete old image
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function deleteImage()
	{
		$imagePath = public_path() . $this->imagePath . $this->id . '/';
		// delete old image
		if(File::exists($imagePath . $this->image)) {
			File::delete($imagePath . $this->image);
		}
		if(File::exists($imagePath . 'origin_' . $this->image)) {
			File::delete($imagePath . 'origin_' . $this->image);
		}
		$this->avatar = null;
	}
	
	/**
	 * Set new notification for user (with sending email letter)
	 * 
	 * @param $notificationType
	 * @param array $variables
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function setNotification($notificationType, $variables = [])
	{
		$notification = new Notification();
		$notification->add($this, $notificationType, $variables);
	}
}
