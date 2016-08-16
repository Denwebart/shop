<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderProduct
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property float $price
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OrderProduct whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OrderProduct whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OrderProduct whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OrderProduct wherePrice($value)
 * @mixin \Eloquent
 */
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

	/**
	 * @return mixed
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * Product
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function product()
	{
		return $this->belongsTo('App\Models\Product', 'product_id');
	}

	/**
	 * Order
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function order()
	{
		return $this->belongsTo('App\Models\Order', 'order_id');
	}
}