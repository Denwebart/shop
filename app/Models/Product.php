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

use App\Helpers\Str;
use App\Helpers\Translit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class Product extends Model
{
	protected $table = 'products';

	protected $imagePath = '/uploads/products/';

	/**
	 * Статус публикации (значение поля is_published)
	 */
	const UNPUBLISHED = 0;
	const PUBLISHED   = 1;

	public static $is_published = [
		self::UNPUBLISHED => 'Не опубликован',
		self::PUBLISHED   => 'Опубликован',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'category_id',
		'user_id',
		'alias',
		'vendor_code',
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
	
	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected static $rules = [
		'category_id' => 'required|integer',
		'user_id' => 'integer',
		'alias' => 'unique:products,alias,:id|max:500|regex:/^[A-Za-z0-9\-]+$/u',
		'vendor_code' => 'unique:products,vendor_code,:id|max:50|regex:/^[А-Яа-яA-Za-z0-9\-]+$/u',
		'is_published' => 'boolean',
		'title' => 'required|max:250',
		'price' => 'required|numeric|between:0,9999999999.99',
		'image' => 'image|max:3072',
		'image_alt' => 'max:350',
		'meta_title' => 'max:300',
		'meta_desc' => 'max:300',
		'meta_key' => 'max:300',
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

	public static function boot()
	{
		parent::boot();

		static::saving(function($product) {
			$product->alias = Translit::generateAlias($product->title, $product->alias);
		});
	}

	/**
	 * Категория
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function category()
	{
		return $this->belongsTo('App\Models\Page', 'category_id');
	}

	/**
	 * Images
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function images()
	{
		return $this->hasMany('App\Models\ProductImage', 'product_id');
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
		return $this->image ? asset($this->imagePath . $this->id . '/' . $this->image) : '';
	}
	
	/**
	 * @return mixed
	 */
	public function getPrice()
	{
		return Str::priceFormat($this->price);
	}

	/**
	 * Заполнение данных при создании и редактировании
	 *
	 * @param $data
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function setData($data)
	{
		if ($data['is_published'] && is_null($this->published_at)) {
			$data['published_at'] = Carbon::now();
		} elseif (!$data['is_published']) {
			$data['published_at'] = null;
		}
		
		$data['user_id'] = $this->user_id ? $this->user_id : Auth::user()->id;

		return $data;
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
		$postImage = $request->file('image');
		if (isset($postImage)) {
			$fileName = Translit::generateFileName($postImage->getClientOriginalName());
			$imagePath = public_path() . $this->imagePath . $this->id . '/';
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
			if($request->get('deleteImage')) {
				$this->deleteImage();
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
		$imagePath = public_path() . $this->imagePath . $this->id . '/';
		// delete old image
		if(File::exists($imagePath . $this->image)) {
			File::delete($imagePath . $this->image);
		}
		$this->image = null;
	}
}
