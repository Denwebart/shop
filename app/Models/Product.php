<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
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

/**
 * App\Models\Product
 *
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
 * @property-read \App\Models\Page $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderProduct[] $orderProducts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderProduct[] $groupedOrderProducts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductImage[] $images
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
class Product extends Model
{
	protected $table = 'products';

	protected $imagePath = '/uploads/products/';
	
	public $ratingInfo = [
		1 => 0,
		2 => 0,
		3 => 0,
		4 => 0,
		5 => 0,
		'sum' => 0,
		'value' => 0
	];
	public $rating;

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
		'vendor_code' => 'required|unique:products,vendor_code,:id|max:50|regex:/^[А-Яа-яA-Za-z0-9\-]+$/u',
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
			if(trim(strip_tags($product->introtext)) == '') {
				$product->introtext = '';
			}
			if(trim(strip_tags($product->content)) == '') {
				$product->content = '';
			}
		});
		static::deleting(function($product) {
			$product->images()->delete();
			$product->deleteImagesFolder();
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
	 * Order products
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\hasMany
	 */
	public function orderProducts()
	{
		return $this->hasMany('App\Models\OrderProduct', 'product_id');
	}
	
	public function groupedOrderProducts()
	{
		return $this->hasMany('App\Models\OrderProduct', 'product_id')
			->select(\DB::raw('*, count(*) as boughtTimes, orders_products.id as id'))
			->groupBy('orders_products.product_id', 'orders_products.order_id');
	}

	/**
	 * Images
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function images()
	{
		return $this->hasMany('App\Models\ProductImage', 'product_id')->with('product');
	}

	/**
	 * All Reviews
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function reviews()
	{
		return $this->hasMany('App\Models\ProductReview', 'product_id');
	}

	/**
	 * Reviews
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function publishedReviews()
	{
		return $this->hasMany('App\Models\ProductReview', 'product_id')
			->whereIsPublished(1)
			->where('published_at', '<=', Carbon::now());
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getMetaTitle()
	{
		return $this->meta_title ? $this->meta_title : '';
	}

	public function getMetaDesc()
	{
		return $this->meta_desc ? $this->meta_desc : '';
	}

	public function getMetaKey()
	{
		return $this->meta_key ? $this->meta_key : '';
	}
	
	/**
	 * Get page url
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getUrl()
	{
		if($this->category) {
			return url($this->category->getUrl() . '/' . $this->alias);
		} else {
			return url($this->alias);
		}
	}

	/**
	 * Reviews
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getReviews()
	{
		return $this->publishedReviews()
			->with('user', 'publishedChildren')
			->whereParentId(0)
			->orderBy('published_at', 'DESC')->get();
	}

	/**
	 * Rating info
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getRating()
	{
		$reviewsRating = ProductReview::whereParentId(0)
			->whereIsPublished(1)
			->where('rating', '!=', 0)
			->whereNotNull('rating')
			->where('published_at', '<=', Carbon::now())
			->select(\DB::raw('rating, COUNT(*) as count'))
			->groupBy('rating')
			->get();

		$totalRating = 0;
		$totalSum = 0;
		foreach ($reviewsRating as $item) {
			$this->ratingInfo[$item->rating] = $item->count;
			$totalRating = $totalRating + ($item->rating * $item->count);
			$totalSum = $totalSum + $item->count;
		}
		$ratingValue = $totalSum ? ($totalRating / $totalSum) : 0;

		$this->ratingInfo['sum'] = $totalSum;
		$this->ratingInfo['value'] = round($ratingValue, 2);

		return $this->ratingInfo;
	}

	/**
	 * Get array with breadcrumb items
	 *
	 * @return array
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getBreadcrumbItems()
	{
		$items[] = [
			'url' => url('/'),
			'title' => 'Главная',
		];
		if($this->category) {
			$items = $items + $this->category->getBredcrumbItem($this->category, 1);
			$items[] = [
				'url' => $this->category->getUrl(),
				'title' => $this->category->getTitle(),
			];
		}

		$items[] = [
			'url' => null,
			'title' => $this->title,
		];

		return $items;
	}

	/**
	 * Get image url
	 *
	 * @param bool $default
	 * @param null $prefix
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getImageUrl($prefix = null, $default = true)
	{
		$prefix = is_null($prefix) ? '' : ($prefix . '_');
		return $this->image
			? asset($this->imagePath . $this->id . '/' . $prefix . $this->image)
			: ($default
				? asset('images/product-default-image.jpg')
			    : '');
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
		return public_path() . $this->imagePath . $this->id . '/';
	}

	/**
	 * @return mixed
	 */
	public function getPrice()
	{
		return $this->price;
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
		$imagePath = $this->getImagesPath();
		if (isset($postImage)) {
			$fileName = Translit::generateFileName($postImage->getClientOriginalName());
			$image = Image::make($postImage->getRealPath());
			File::exists($imagePath) or File::makeDirectory($imagePath, 0755, true);

			// delete old image
			$this->deleteImages();

			$watermark = Image::make(public_path('images/watermark.png'));

			$image->save($imagePath . 'origin_' . $fileName);
			
			if ($image->width() >= 1200 && $image->height() >= 1507) {
				$height = $image->height();
				$width = $height / 1.255;

				if($image->width() < $image->height()) {
					if($image->width() < ($image->height() / 1.255)) {
						$width = $image->width();
						$height = $width * 1.255;
					}
				}
				$image->crop((integer) $width, (integer) $height);
				$image->resize(1200, null, function ($constraint) {
						$constraint->aspectRatio();
					});
			} else {
				if($image->height() < ($image->width() * 1.255)) {
					$height = $image->height();
					$width = $height / 1.255;
				} else {
					$width = $image->width();
					$height = $width * 1.255;
				}
				$image->crop((integer) $width, (integer) $height);
			}

			$watermark->resize(($image->width() * 2) / 3, null, function ($constraint) {
				$constraint->aspectRatio();
			})->save($imagePath . 'watermark.png');
			$image->insert($imagePath . 'watermark.png', 'center')
				->save($imagePath . 'zoom_' . $fileName);

			$image->resize(458, null, function ($constraint) {
					$constraint->aspectRatio();
				})->crop(458, 575)
				->save($imagePath . $fileName);

			$image->resize(100, null, function ($constraint) {
					$constraint->aspectRatio();
				})->crop(100, 126)
				->save($imagePath . 'mini_' . $fileName);

			if (File::exists($imagePath . 'watermark.png')) {
				File::delete($imagePath . 'watermark.png');
			}

			$this->image = $fileName;
			return true;
		} else {
			if($request->get('deleteImage')) {
				$this->deleteImages();
				if(!File::exists($imagePath . 'images')) {
					$this->deleteImagesFolder();
				}
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
	public function deleteImages()
	{
		$prefixes = ['', 'origin_', 'zoom_', 'mini_'];
		// delete old image
		foreach ($prefixes as $prefix) {
			if(File::exists($this->getImagesPath() . $prefix . $this->image)) {
				File::delete($this->getImagesPath() . $prefix . $this->image);
			}
		}
		$this->image = null;
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
