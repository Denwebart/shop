<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use App\Helpers\Translit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

/**
 * App\Models\Page
 *
 * @property integer $id
 * @property string $alias
 * @property integer $parent_id
 * @property integer $user_id
 * @property boolean $type
 * @property boolean $is_published
 * @property boolean $is_container
 * @property string $title
 * @property string $menu_title
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
 * @property-read \App\Models\Page $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Page[] $children
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Page[] $publishedChildren
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereAlias($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereIsPublished($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereIsContainer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereMenuTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereImageAlt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereIntrotext($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page wherePublishedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereMetaTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereMetaDesc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereMetaKey($value)
 * @mixin \Eloquent
 */
class Page extends Model
{
	protected $table = 'pages';

	protected $imagePath = '/uploads/pages/';

	/**
	 * Максимальная вложнность страниц
	 */
	const MAX_LEVEL = 4; // 4 уровня

	/**
	 * Тип страницы (значение поля type)
	 */
	const TYPE_PAGE        = 1;
	const TYPE_SYSTEM_PAGE = 2;
	const TYPE_CATALOG     = 3;

	public static $types = [
		self::TYPE_PAGE        => 'Страница',
		self::TYPE_SYSTEM_PAGE => 'Системная страница',
		self::TYPE_CATALOG     => 'Каталог',
	];

	/**
	 * Статус публикации (значение поля is_published)
	 */
	const UNPUBLISHED = 0;
	const PUBLISHED   = 1;

	public static $is_published = [
		self::UNPUBLISHED => 'Не опубликована',
		self::PUBLISHED   => 'Опубликована',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'alias',
		'parent_id',
		'user_id',
		'type',
		'is_published',
		'is_container',
		'title',
		'menu_title',
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
		'alias' => 'unique:pages,alias,:id|max:500|regex:/^[A-Za-z0-9\-]+$/u',
		'parent_id' => 'integer',
		'user_id' => 'integer',
		'type' => 'integer',
		'is_published' => 'boolean',
		'is_container' => 'boolean',
		'title' => 'required_without:menu_title|max:250',
		'menu_title' => 'required_without:title|max:50',
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

		static::saving(function($page) {
			if(!$page->isMain()) {
				$page->alias = Translit::generateAlias($page->getTitle(), $page->alias);
			} else {
				$page->alias = '/';
			}
			if(trim(strip_tags($page->introtext)) == '') {
				$page->introtext = '';
			}
			if(trim(strip_tags($page->content)) == '') {
				$page->content = '';
			}
		});
	}

	/**
	 * Автор
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function user()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}

	/**
	 * Родительская страница
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function parent()
	{
		return $this->belongsTo('App\Models\Page', 'parent_id');
	}

	/**
	 * Все дочерние страницы
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function children()
	{
		return $this->hasMany('App\Models\Page', 'parent_id');
	}
	
	/**
	 * Опубликованные дочерние страницы
	 * 
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function publishedChildren()
	{
		return $this->hasMany('App\Models\Page', 'parent_id')
			->whereIsPublished(1)
			->where('published_at', '<', date('Y-m-d H:i:s'));
	}
	
	/**
	 * Is main page?
	 * @return bool
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function isMain()
	{
		return $this->id == 1 ? true : false;
	}

	/**
	 * Can page be deleted?
	 * @return bool
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function canBeDeleted()
	{
		return ($this->type != self::TYPE_SYSTEM_PAGE || !$this->type) ? true : false;
	}

	/**
	 * Get page title (menu_title or title)
	 * 
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getTitle()
	{
		return $this->menu_title ? $this->menu_title : $this->title;
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
		if($this->parent_id) {
			return url($this->parent->getUrl() . '/' . $this->alias);
		} else {
			return url($this->alias);
		}
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
		$items = $items + $this->getBredcrumbItem($this, 1);
		$items[] = [
			'url' => null,
			'title' => $this->getTitle(),
		];

		return $items;
	}

	/**
	 * Recursive function for get breadcrumbs item
	 *
	 * @param $level
	 * @return array
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getBredcrumbItem($page, $level)
	{
		if($page->parent) {
			$items = $page->getBredcrumbItem($page->parent, $level + 1);
			$items[$level] = [
				'url' => $page->parent->getUrl(),
				'title' => $page->parent->getTitle(),
			];
		}
		return isset($items) ? $items : [];
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
	 * Get categories array
	 *
	 * @param bool $pageType
	 * @param bool $empty
	 * @return array List of categories (id => title)
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function getCategory($pageType = false, $empty = true)
	{
		$query = new Page();
		$query = $query->select('id', 'parent_id', 'alias', 'title', 'menu_title', 'is_container', 'type');
		$query = $query->whereIsContainer(1)
			->whereParentId(0)
			->where('type', '!=', self::TYPE_SYSTEM_PAGE);

		if($pageType) {
			$query = $query->where('type', '=', $pageType);
		}

		$pages = $query->get();
		
		$array = [];
		if($empty) {
			$array[0] = '&mdash;'; // тире
		}
		foreach ($pages as $page) {
			$array[$page->id] = $page->getTitle();

			$array = $array + self::getCategoryChildren($page, 1);
		}
		return $array;
	}

	/**
	 * Recursive function for get child page array
	 *
	 * @param $page
	 * @param $level
	 * @return array
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 *
	 */
	protected static function getCategoryChildren($page, $level)
	{
		if($level < (self::MAX_LEVEL - 1)) {
			if(count($page->children)) {
				foreach($page->children()->whereIsContainer(1)->get() as $child) {
					$array[$child->id] = ' ' . str_repeat('&mdash; ', $level) . $child->getTitle();
					if(count($child->children)) {
						$array = $array + self::getCategoryChildren($child, $level + 1);
					}
				}
			}
		}
		return isset($array) ? $array : [];
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

		if(!$this->type && $this->type != Page::TYPE_SYSTEM_PAGE) {
			if($data['is_catalog']) {
				$data['type'] = Page::TYPE_CATALOG;
				$data['is_container'] = 1;
			} else {
				$data['type'] = Page::TYPE_PAGE;
			}
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
			
			if ($image->width() > 760) {
				$image->resize(760, null, function ($constraint) {
					$constraint->aspectRatio();
				})->save($imagePath . $fileName);
			} else {
				$image->save($imagePath . $fileName);
			}
			
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
