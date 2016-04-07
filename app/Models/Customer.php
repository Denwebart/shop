<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 * 
 * App\Models\Customer
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $username
 * @property string $phone
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer wherePhone($value)
 * @mixin \Eloquent
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	protected $table = 'customers';
	
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'user_id',
		'username',
		'phone',
	];
}