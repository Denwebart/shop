<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 * 
 * App\Models\Order
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $coupon_id
 * @property float $total_price
 * @property boolean $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $paid_at
 * @property string $closed_at
 * @property boolean $payment_type
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereCouponId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereTotalPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order wherePaidAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereClosedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order wherePaymentType($value)
 * @mixin \Eloquent
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table = 'orders';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'customer_id',
		'coupon_id',
		'total_price',
		'status',
		'paid_at',
		'closed_at',
		'payment_type',
	];
}