<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 * 
 * App\Models\Coupon
 *
 * @property integer $id
 * @property string $code
 * @property string $description
 * @property float $value
 * @property boolean $type
 * @property integer $quantity
 * @property string $date_start
 * @property string $date_end
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Coupon whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Coupon whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Coupon whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Coupon whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Coupon whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Coupon whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Coupon whereDateStart($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Coupon whereDateEnd($value)
 * @mixin \Eloquent
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
	protected $table = 'coupons';

	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'code',
		'description',
		'value',
		'type',
		'quantity',
		'date_start',
		'date_end',
	];
}