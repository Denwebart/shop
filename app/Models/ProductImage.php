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

	protected $imagePath = '/uploads/products/';

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

	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected static $rules = [
		'user_id' => 'integer',
		'image' => 'image|max:3072',
		'image_alt' => 'max:350',
		'position' => 'integer',
	];

	/**
	 * Get validation rules
	 *
	 * @param bool $id
	 * @return array
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function rules($id = false)
	{
		$rules = self::$rules;
		if ($id) {
			foreach ($rules as &$rule) {
				$rule = str_replace(':id', $id, $rule);
			}
		}
		return $rules;
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
	 * Get image url
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getImageUrl()
	{
		return $this->product ? asset($this->imagePath . $this->product->id . '/images/' . $this->id . '/' . $this->image) : '';
	}
}