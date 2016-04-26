<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use App\Helpers\Str;
use Illuminate\Database\Eloquent\Model;

/**
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
		'user_id',
		'username',
		'phone',
	];

	/**
	 * @return string
	 */
	public function getPhone()
	{
		return Str::phoneFormat($this->phone);
	}
}