<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserSetting
 *
 * @property integer $user_id
 * @property boolean $permission_letters
 * @property boolean $permission_products_reviews
 * @property boolean $permission_shop_reviews
 * @property boolean $permission_requested_calls
 * @property boolean $permission_orders
 * @property boolean $permission_products
 * @property boolean $permission_pages
 * @property boolean $permission_users
 * @property boolean $permission_settings
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting wherePermissionLetters($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting wherePermissionProductsReviews($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting wherePermissionShopReviews($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting wherePermissionRequestedCalls($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting wherePermissionOrders($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting wherePermissionProducts($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting wherePermissionPages($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting wherePermissionUsers($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting wherePermissionSettings($value)
 * @mixin \Eloquent
 */
class UserSetting extends Model
{
	protected $table = 'users_settings';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
	    'user_id',
	    'permission_letters',
	    'permission_products_reviews',
	    'permission_shop_reviews',
	    'permission_requested_calls',
	    'permission_orders',
	    'permission_products',
	    'permission_pages',
	    'permission_users',
	    'permission_settings',
    ];

	/**
	 * Настройки аккаунта пользователя
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function user()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}
}
