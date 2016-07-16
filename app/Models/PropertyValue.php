<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

/**
 * App\Models\PropertyValue
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $property_id
 * @property string $value
 * @property string $additional_value
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PropertyValue whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PropertyValue wherePropertyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PropertyValue whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PropertyValue whereAdditionalValue($value)
 */
class PropertyValue extends Model
{
	protected $table = 'property_values';

	protected $imagePath = '/uploads/properties_values/';

	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'property_id',
		'value',
		'additional_value',
	];
	
	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static $rules = [
		'property_id' => 'integer',
		'value' => 'required|max:125',
		'additional_value' => 'max:125',
	];

	/**
	 * Get validation rules for current field
	 *
	 * @param null $attribute
	 * @return array|mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getRules($attribute = null)
	{
		if($attribute) {
			return [$attribute => self::$rules[$attribute]];
		}
		return self::$rules;
	}

	public static function boot()
	{
		parent::boot();

		static::saving(function($model) {
			if(trim(strip_tags($model->additional_value)) == '') {
				$model->additional_value = null;
			}
			if(count($model->productsPropertyValues)) {
				\Cache::forget('leadersOfSells');
				\Cache::forget('widgets.carousel.sale');
			}
		});

		static::deleting(function($model) {
			if(count($model->productsPropertyValues)) {
				\Cache::forget('leadersOfSells');
				\Cache::forget('widgets.carousel.sale');
			}
			$model->productsPropertyValues()->delete();
			$model->deleteImagesFolder();
		});
	}

	/**
	 * Property
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function property()
	{
		return $this->belongsTo('App\Models\Property', 'property_id');
	}

	/**
	 * Products
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function products()
	{
		return $this->belongsToMany('App\Models\Product', 'products_property_values');
	}

	/**
	 * Products Property Values
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function productsPropertyValues()
	{
		return $this->hasMany('App\Models\ProductPropertyValue', 'property_value_id');
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
		return $this->additional_value
			? (is_int($this->property_id)
				? asset($this->imagePath . 'property-' .$this->property_id . '/' . $this->id . '/' . $this->additional_value)
				: asset($this->imagePath . $this->id . '/' . $this->additional_value)
			)
			: '';
	}

	/**
	 * Get image path
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getImagesPath()
	{
		return is_int($this->property_id)
			? public_path() . $this->imagePath . 'property-' . $this->property_id . '/' . $this->id . '/'
			: public_path() . $this->imagePath . $this->id . '/';
	}

	/**
	 * Image uploading
	 *
	 * @param Request $request
	 * @return bool
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function setImage(Request $request)
	{
		$postImage = $request->file('additional_value');
		$imagePath = $this->getImagesPath();
		if (isset($postImage)) {
			$fileName = Translit::generateFileName($postImage->getClientOriginalName());
			$image = Image::make($postImage->getRealPath());
			File::exists($imagePath) or File::makeDirectory($imagePath, 0755, true);

			// delete old image
			$this->deleteImage();
			
			$image->save($imagePath . $fileName);
		
			$this->additional_value = $fileName;
			return true;
		} else {
			if($request->get('deleteImage')) {
				$this->deleteImage();
				$this->deleteImagesFolder();
				return true;
			}
			return false;
		}
	}

	/**
	 * Delete old image
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function deleteImage()
	{
		if($this->property && $this->property->type == Property::TYPE_BRAND) {
			if(File::exists($this->getImagesPath() . $this->additional_value)) {
				File::delete($this->getImagesPath() . $this->additional_value);
			}
			$this->additional_value = null;
		}
	}

	/**
	 * Delete image folder
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function deleteImagesFolder()
	{
		File::deleteDirectory($this->getImagesPath());
	}
}