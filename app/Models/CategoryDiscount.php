<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CategoryDiscount
 *
 * @property integer $category_id
 * @property integer $discount_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CategoryDiscount whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CategoryDiscount whereDiscountId($value)
 * @mixin \Eloquent
 */
class CategoryDiscount extends Model
{
	protected $table = 'categories_discounts';

	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'category_id',
		'discount_id',
	];
}