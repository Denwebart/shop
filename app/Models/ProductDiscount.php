<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 * 
 * App\Models\ProductDiscount
 *
 * @property integer $product_id
 * @property integer $discount_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductDiscount whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductDiscount whereDiscountId($value)
 * @mixin \Eloquent
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDiscount extends Model
{
	protected $table = 'products_discounts';

	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'product_id',
		'discount_id',
	];
}