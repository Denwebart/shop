<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderDeliveryType
 *
 * @mixin \Eloquent
 */
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