<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductPropertyValue
 *
 * @mixin \Eloquent
 * @property integer $product_id
 * @property integer $property_value_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductPropertyValue whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductPropertyValue wherePropertyValueId($value)
 */
class ProductPropertyValue extends Model
{
	protected $table = 'products_property_values';

	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'product_id',
		'property_value_id',
	];
	
	public static function boot()
	{
		parent::boot();
		
		static::saving(function($model) {
			if($model->product) {
				\Cache::forget('leadersOfSells');
			}
		});
		
		static::deleting(function($model) {
			if($model->product) {
				\Cache::forget('leadersOfSells');
			}
		});
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
}