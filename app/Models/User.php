<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 *
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

namespace App\Models;

use App\Helpers\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	protected $table = 'users';

	protected $imagePath = 'uploads/users/';

	/**
	 * Роль пользователя (значение поля role)
	 */
	const ROLE_ADMIN   = 1;
	const ROLE_MANAGER = 2;
	const ROLE_USER    = 3;

	public static $roles = [
		self::ROLE_ADMIN   => 'Администратор',
		self::ROLE_MANAGER => 'Менеджер',
		self::ROLE_USER    => 'Пользователь',
	];
	
	public static $rolesClass = [
		self::ROLE_ADMIN   => 'success',
		self::ROLE_MANAGER => 'info',
		self::ROLE_USER    => 'primary',
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
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'activation_code',
    ];

	/**
	 * Get user's avatar path
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getAvatarUrl() {
		return $this->avatar
			? url($this->imagePath . $this->id . '/' . $this->avatar)
			: url('images/default-avatar.jpg');
	}

	/**
	 * 
	 * @return bool
	 */
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
}
