<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 * 
 * App\Models\Product
 * @property integer $id
 * @property string $vendor_code
 * @property integer $category_id
 * @property integer $user_id
 * @property string $alias
 * @property boolean $is_published
 * @property string $title
 * @property float $price
 * @property string $image
 * @property string $image_alt
 * @property string $introtext
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $published_at
 * @property string $meta_title
 * @property string $meta_desc
 * @property string $meta_key
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product whereVendorCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product whereAlias($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product whereIsPublished($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product whereImageAlt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product whereIntrotext($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product wherePublishedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product whereMetaTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product whereMetaDesc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product whereMetaKey($value)
 * @mixin \Eloquent
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $table = 'products';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'category_id',
		'user_id',
		'alias',
		'is_published',
		'title',
		'price',
		'image',
		'image_alt',
		'introtext',
		'content',
		'published_at',
		'meta_title',
		'meta_desc',
		'meta_key',
	];
}
