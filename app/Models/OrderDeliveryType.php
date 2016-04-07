<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 * 
 * App\Models\OrderDeliveryType
 *
 * @property integer $order_id
 * @property integer $delivery_type_id
 * @property string $address
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OrderDeliveryType whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OrderDeliveryType whereDeliveryTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OrderDeliveryType whereAddress($value)
 * @mixin \Eloquent
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDeliveryType extends Model
{
	protected $table = 'orders_delivery_types';

	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'order_id',
		'delivery_type_id',
		'address',
	];
}