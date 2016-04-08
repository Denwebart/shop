<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 * 
 * App\Models\ProductHistory
 *
 * @property integer $id
 * @property integer $product_id
 * @property float $price
 * @property string $date_start
 * @property string $date_end
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductHistory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductHistory whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductHistory wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductHistory whereDateStart($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductHistory whereDateEnd($value)
 * @mixin \Eloquent
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductHistory extends Model
{
	protected $table = 'products_history';

	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'product_id',
		'price',
		'date_start',
		'date_end',
	];
}