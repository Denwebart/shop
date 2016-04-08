<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 * 
 * App\Models\ProductImage
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $image
 * @property string $image_alt
 * @property boolean $position
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductImage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductImage whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductImage whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductImage whereImageAlt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductImage wherePosition($value)
 * @mixin \Eloquent
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
	protected $table = 'products_images';

	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'product_id',
		'image',
		'image_alt',
		'position',
	];
}