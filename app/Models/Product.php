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

	public $rating = 0;
	public $previous;
	public $next;

	public static $sortingAttributes = [
        'published_at',
		'price',
		'rating',
		'popular',
	];

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
		'category_id' => 'required|integer|not_in:0',
		'user_id' => 'integer',
		'alias' => 'unique:products,alias,:id|max:500|regex:/^[A-Za-z0-9\-]+$/u',
		'vendor_code' => 'required|unique:products,vendor_code,:id|max:50|regex:/^[А-Яа-яA-Za-z0-9 \-]+$/u',
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
			$product->vendor_code = trim($product->vendor_code);
			
			\Cache::forget('leadersOfSells');
			\Cache::forget('widgets.carousel.sale');
		});
		
		static::deleting(function($product) {
			$product->images()->delete();
			$product->deleteImagesFolder();
			
			\Cache::forget('leadersOfSells');
			\Cache::forget('widgets.carousel.sale');
			
			\Cache::forget('sitemapItems.children-' . $page->parent_id);
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

	/**
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function productProperties()
	{
		return $this->belongsToMany('App\Models\PropertyValue', 'products_property_values');
	}

	/**
	 * Get product properties
	 * 
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
    public function getProperties($propertyId = null)
    {
	    $query = Property::whereHas('values', function ($q) {
		    $q->leftJoin('products_property_values', 'products_property_values.property_value_id', '=', 'property_values.id')
			    ->where('products_property_values.product_id', '=', $this->id)
		        ->addSelect('products_property_values.id as product_property_value_id');
	    })->with(['values' => function ($q) {
		    $q->leftJoin('products_property_values', 'products_property_values.property_value_id', '=', 'property_values.id')
			    ->where('products_property_values.product_id', '=', $this->id);
	    }]);

	    if($propertyId) {
		    $query->whereId($propertyId);
	    }

	    return $query->get();
    }

	/**
	 * Get properties color
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function propertyColor()
	{
		return $this->belongsToMany('App\Models\PropertyValue', 'products_property_values')
			->whereHas('property', function ($q) {
				$q->where('type', '=', Property::TYPE_COLOR);
			})->with(['property' => function ($q) {
				$q->where('type', '=', Property::TYPE_COLOR);
			}]);
	}

	/**
	 * Get properties size
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function propertySize()
	{
		return $this->belongsToMany('App\Models\PropertyValue', 'products_property_values')
			->whereHas('property', function ($q) {
				$q->where('type', '=', Property::TYPE_SIZE);
			})->with(['property' => function ($q) {
				$q->where('type', '=', Property::TYPE_SIZE);
			}]);
	}

	/**
	 * Get properties tag
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function propertyTag()
	{
		return $this->belongsToMany('App\Models\PropertyValue', 'products_property_values')
			->whereHas('property', function ($q) {
				$q->where('type', '=', Property::TYPE_TAG);
			})->with(['property' => function ($q) {
				$q->where('type', '=', Property::TYPE_TAG);
			}])->limit(1);
	}

	public function getTitle()
	{
		return $this->title;
	}
	
	public function getMetaTitle()
	{
		return $this->meta_title
			? $this->meta_title
			: ($this->getTitle() ? $this->getTitle() : '');
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
	 * Description for meta-tag og:description
	 * @param null $limit
	 * @return string
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getDescription($limit = null)
	{
		$limit = $limit ? $limit : 250;
		return $this->introtext
			? Str::closeTags(Str::limit($this->introtext, $limit))
			: Str::closeTags(Str::limit($this->content, $limit));
	}
	
	public function getIntrotext($limit = null)
	{
		$limit = $limit ? $limit : 500;
		return $this->introtext
			? $this->introtext
			: Str::closeTags(Str::limit($this->content, $limit));
	}
	
	public function getPageImage()
	{
		return $this->getImageUrl(null, false)
			? $this->getImageUrl(null, false)
			: ((count($this->images) && $this->images()->first())
				? $this->images()->first()->getImageUrl()
				: $this->getDefaultImage());
	}

	/**
	 * Get page url
	 *
	 * @param array $parameters
	 * @return string
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getUrl($parameters = [])
	{
		$parameters = count($parameters)
			? urldecode("?" . http_build_query($parameters))
			: '';
		if($this->category) {
			return url($this->category->getUrl() . '/' . $this->alias) . $parameters;
		} else {
			return url($this->alias) . $parameters;
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
		$reviewsRating = ProductReview::whereProductId($this->id)
			->whereParentId(0)
			->whereIsPublished(1)
			->where('published_at', '<=', Carbon::now())
			->where('rating', '!=', 0)
			->whereNotNull('rating')
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

	public function getImagePath()
	{
		return $this->imagePath;
	}

	public function getDefaultImage()
	{
		return asset('images/product-default-image.jpg');
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
				? $this->getDefaultImage()
			    : '');
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
				$width = $height / 1.257;

				if($image->width() < $image->height()) {
					if($image->width() < ($image->height() / 1.257)) {
						$width = $image->width();
						$height = $width * 1.257;
					}
				}
				$image->crop((integer) $width, (integer) $height);
				$image->resize(1200, null, function ($constraint) {
						$constraint->aspectRatio();
					});
			} else {
				if($image->height() < ($image->width() * 1.257)) {
					$height = $image->height();
					$width = $height / 1.257;
				} else {
					$width = $image->width();
					$height = $width * 1.257;
				}
				$image->crop((integer) $width, (integer) $height);
			}

			$watermark->resize(($image->width() * 2) / 3, null, function ($constraint) {
				$constraint->aspectRatio();
			})->save($imagePath . 'watermark.png');
			$image->insert($imagePath . 'watermark.png', 'center')
				->save($imagePath . 'zoom_' . $fileName);

			$image->resize(335, null, function ($constraint) {
					$constraint->aspectRatio();
				})->crop(335, 421)
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

	/**
	 * Добавлен ли товар в список желаний (есть ли в cookie)
	 *
	 * @return bool
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function inWishlist()
	{
		$wishlistProducts = \Request::cookie('wishlist', []);
		return key_exists($this->id, $wishlistProducts) ? true : false;
	}

	protected function queryPreviousNext($sortby, $categoriesIds)
	{
//		\DB::statement("SET @num = 0");
		//доделать - из-за join неправильное значение position (по рейтингу и популярности ошибка на товарах, где есть значение)
		$query = Product::select(\DB::raw('products.id, products.category_id, products.alias, products.is_published, products.title, products.image, products.image_alt, products.published_at, @num := @num + 1 AS `position`'))
			->where('products.is_published', '=', 1)
			->where('products.published_at', '<=', Carbon::now())
			->with([
				'category' => function($q) {
					$q->select(['id', 'parent_id', 'alias', 'is_container']);
				},
				'category.parent' => function($q) {
					$q->select(['id', 'parent_id', 'alias', 'is_container']);
				},
			]);
		if(isset($categoriesIds)) {
			$query = $query->whereIn('products.category_id', $categoriesIds);
		}
		
		/* БЫЛО */
		/*
		if($sortby == 'popular') {
			// sales (popular)
			$query->leftJoin('orders_products', 'orders_products.product_id', '=', 'products.id')
				->addSelect(\DB::raw('IFNULL(COUNT(orders_products.id), 0) as `popular`'));

			$query->leftJoin('products_reviews', 'products_reviews.product_id', '=', 'products.id')
				->where(function($q) {
					$q->where(function ($qu) {
						$qu->where('products_reviews.is_published', '=', 1)
							->where('products_reviews.parent_id', '=', 0)
							->where('products_reviews.rating', '!=', 0);
					})->orWhere('products_reviews.id', '=', null);
				})
				->addSelect(\DB::raw('IFNULL((SUM(products_reviews.rating) / COUNT(products_reviews.id)), 0) as `rating`'));
		}
		if($sortby == 'rating') {
			// rating
			$query->leftJoin('products_reviews', 'products_reviews.product_id', '=', 'products.id')
				->where(function($q) {
					$q->where(function ($qu) {
						$qu->where('products_reviews.is_published', '=', 1)
							->where('products_reviews.parent_id', '=', 0)
							->where('products_reviews.rating', '!=', 0);
					})->orWhere('products_reviews.id', '=', null);
				})
				->addSelect(\DB::raw('IFNULL((SUM(products_reviews.rating) / COUNT(products_reviews.id)), 0) as `rating`'));
			$query->raw(\DB::raw('join (SELECT @num := -1) r'));
		}
		*/

		/* БЫЛО */

		if($sortby == 'popular') {
			$query->leftJoin('orders_products', 'orders_products.product_id', '=', 'products.id')
				->addSelect(\DB::raw('COUNT(distinct orders_products.id) as `popular`'));

			$query->leftJoin('products_reviews', 'products_reviews.product_id', '=', 'products.id')
				->where(function($q) {
					$q->where(function ($qu) {
						$qu->where('products_reviews.parent_id', '=', 0);
					})->orWhereNull('products_reviews.id');
				})
				->addSelect(\DB::raw('COUNT(distinct products_reviews.id) as reviews_count'));

			$query->orderBy('popular', 'ASC');
			$query->orderBy('reviews_count', 'ASC');
		}
		// sort by rating
		elseif($sortby == 'rating') {
			$query->leftJoin('products_reviews', 'products_reviews.product_id', '=', 'products.id')
				->where(function($q) {
					$q->where(function ($qu) {
						$qu->where('products_reviews.parent_id', '=', 0);
					})->orWhereNull('products_reviews.id');
				})
				->addSelect(\DB::raw('CASE WHEN (products_reviews.is_published = 1 && products_reviews.rating != 0) THEN (SUM(products_reviews.rating) / COUNT(CASE WHEN (products_reviews.is_published = 1 && products_reviews.rating != 0) THEN 1 END)) ELSE 0 END as rating'));
			$query->orderBy($sortby, 'ASC');
//			$query->addSelect(\DB::raw('@num := -1 r'));
//			$query->raw(\DB::raw('join (SELECT @num := -1) r'));
		} else {
			$query->orderBy($sortby, 'ASC');
		}
		$query->groupBy('products.id');
		$query->orderBy('products.published_at', 'ASC');


//		foreach ($query->get() as $item) {
//			echo $item->title;
//			echo ' - ';
//			echo $item->position;
//			echo '<br>';
//		}
//		dd();

		return $query;
	}

	public function getPreviousNext($sortby)
	{
		// доделать вложенность (рекурсивно?) - не хватает 1-го уровня
		if($this->category) {
			$categoriesQuery = Page::select(['id', 'parent_id'])
				->whereIsPublished(1)
				->where('published_at', '<=', Carbon::now());
			if($this->category->parent && $this->category->parent->type == Page::TYPE_CATALOG) {
				$categoriesQuery->whereIn('parent_id', [$this->category->id, $this->category->parent->id]);
			} else {
				$categoriesQuery->whereParentId($this->category->id);
			}

			$categoriesIds = $categoriesQuery->pluck('id');

			$categoriesIds[] = $this->category->id;
			if($this->category->parent && $this->category->parent->type == Page::TYPE_CATALOG) {
				$categoriesIds[] = $this->category->parent->id;
			}
		}

		// current position
		\DB::statement("SET @num = 0");
		$currentPosition = \DB::table(\DB::raw("({$this->queryPreviousNext($sortby, $categoriesIds)->toSql()}) as sub") )
			->mergeBindings($this->queryPreviousNext($sortby, $categoriesIds)->getQuery())
			->select('position')
			->where('id', '=', $this->id)
			->first();

		if($currentPosition) {
			\DB::statement("SET @num = 0");
			$result = \DB::table(\DB::raw("({$this->queryPreviousNext($sortby, $categoriesIds)->toSql()}) as sub") )
				->mergeBindings($this->queryPreviousNext($sortby, $categoriesIds)->getQuery())
				->whereIn('position', [$currentPosition->position - 1, $currentPosition->position + 1])
				->orderBy('position', 'DESC')
				->get();

			return $result;
		}
	}

	/**
	 * Get previous product with sorting
	 *
	 * @param $sortby
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getPrevious($sortby)
	{
		return collect($this->getPreviousNext($sortby))->first();
	}

	/**
	 * Get next product with sorting
	 *
	 * @param $sortby
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getNext($sortby)
	{
		return collect($this->getPreviousNext($sortby))->last();
	}

}
