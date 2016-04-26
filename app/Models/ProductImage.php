<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductImage
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $image
 * @property string $image_alt
 * @property boolean $position
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductImage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductImage whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductImage whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductImage whereImageAlt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductImage wherePosition($value)
 * @mixin \Eloquent
 */
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

	/**
	 * Image uploading
	 *
	 * @param $postImage
	 * @return bool
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function setImage($postImage)
	{
		if (isset($postImage)) {
			$fileName = Translit::generateFileName($postImage->getClientOriginalName());
			$imagePath = public_path() . $this->imagePath . $this->product->id . '/images/' . $this->id . '/';
			$image = Image::make($postImage->getRealPath());
			File::exists($imagePath) or File::makeDirectory($imagePath, 0755, true);

			// delete old image
			$this->deleteImage();

			$watermark = Image::make(public_path('images/watermark.png'));
			$watermark->resize(($image->width() * 2) / 3, null, function ($constraint) {
				$constraint->aspectRatio();
			})->save($imagePath . 'watermark.png');

			$image->insert($imagePath . 'watermark.png', 'center')
				->save($imagePath . 'origin_' . $fileName);

			if (File::exists($imagePath . 'watermark.png')) {
				File::delete($imagePath . 'watermark.png');
			}

			if ($image->width() > 1200) {
				$image->resize(1200, null, function ($constraint) {
					$constraint->aspectRatio();
				})->crop(1200, 1507)
					->save($imagePath . 'zoom_' . $fileName);
			} else {
				$width = $image->width();
				$height = $width * 1.255;
				$image->resize($width, null, function ($constraint) {
					$constraint->aspectRatio();
				})->crop($width, (integer) $height)
					->save($imagePath . 'zoom_' . $fileName);
			}

			$image->resize(458, null, function ($constraint) {
				$constraint->aspectRatio();
			})->crop(458, 575)
				->save($imagePath . $fileName);

			$image->resize(100, null, function ($constraint) {
				$constraint->aspectRatio();
			})->crop(100, 126)
				->save($imagePath . 'mini_' . $fileName);

			$this->image = $fileName;
			return true;
		} else {
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
		$imagePath = public_path() . $this->imagePath . $this->product->id . '/images/' . $this->id . '/';
		// delete old image
		if(File::exists($imagePath . 'origin_' . $this->image)) {
			File::delete($imagePath . 'origin_' . $this->image);
		}
		if(File::exists($imagePath . 'zoom_' . $this->image)) {
			File::delete($imagePath . 'zoom_' . $this->image);
		}
		if(File::exists($imagePath . 'mini_' . $this->image)) {
			File::delete($imagePath . 'mini_' . $this->image);
		}
		if(File::exists($imagePath . $this->image)) {
			File::delete($imagePath . $this->image);
		}
		$this->image = null;
	}
}