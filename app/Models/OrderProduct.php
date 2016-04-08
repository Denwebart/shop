<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 * 
 * App\Models\OrderProduct
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property float $price
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OrderProduct whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OrderProduct whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OrderProduct whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OrderProduct wherePrice($value)
 * @mixin \Eloquent
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
	protected $table = 'orders_products';
	
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'order_id',
		'product_id',
		'price',
	];
}