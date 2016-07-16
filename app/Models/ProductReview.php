<?php

/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductReview
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $parent_id
 * @property integer $product_id
 * @property string $user_name
 * @property string $user_email
 * @property string $text
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $published_at
 * @property boolean $is_published
 * @property boolean $rating
 * @property integer $like
 * @property integer $dislike
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\ProductReview $parent
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductReview whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductReview whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductReview whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductReview whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductReview whereUserName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductReview whereUserEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductReview whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductReview whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductReview whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductReview wherePublishedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductReview whereIsPublished($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductReview whereRating($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductReview whereLike($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductReview whereDislike($value)
 * @mixin \Eloquent
 */
class ProductReview extends Model
{
	protected $table = 'products_reviews';
	public $timestamps = false;

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
	 * Полезен или не полезен отзыв (поля в базе)
	 */
	const LIKE    = 'like';
	const DISLIKE = 'dislike';

	public static $votes = [
		self::LIKE    => 'Полезен',
		self::DISLIKE => 'Не полезен',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'product_id',
		'user_name',
		'user_email',
		'text',
		'rating',
		'like',
		'dislike',
		'is_published',
		'published_at',
		'updated_at',
	];

	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected static $rules = [
		'user_id' => 'required_without_all:user_name,user_email|integer',
		'product_id' => 'required|integer',
		'user_name' => 'required_without:user_id|max:50|regex:/^[A-Za-zА-Яа-яЁёЇїІіЄє \-\']+$/u',
		'user_email' => 'required_without:user_id|email|max:100',
		'rating' => 'integer',
		'like' => 'integer',
		'dislike' => 'integer',
		'is_published' => 'integer',
		'text' => 'required',
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

		static::creating(function($model)
		{
			$model->created_at = Carbon::now();
        });
		
		static::saving(function($model) {
			\Cache::forget('leadersOfSells');
			\Cache::forget('product.' . $model->product_id . '.rating');
		});
		
		static::deleting(function($model) {
			\Cache::forget('leadersOfSells');
			\Cache::forget('product.' . $model->product_id . '.rating');
		});
	}
	
	/**
	 * Менеджер, который написал отзыв
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}
	
	/**
	 * Товар, к которому оставлен отзыв
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function product()
	{
		return $this->belongsTo('App\Models\Product', 'product_id');
	}

	/**
	 * Родительский отзыв
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function parent()
	{
		return $this->belongsTo('App\Models\ProductReview', 'parent_id');
	}

	/**
	 * Все комментарии к отзыву
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function children()
	{
		return $this->hasMany('App\Models\ProductReview', 'parent_id');
	}

	/**
	 * Опубликованные комментарии к отзыву
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function publishedChildren()
	{
		return $this->hasMany('App\Models\ProductReview', 'parent_id')
			->with('user')
			->whereIsPublished(1)
			->where('published_at', '<=', Carbon::now());
	}

	/**
	 * Get review url
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getUrl()
	{
		return url($this->product->getUrl());
	}

	/**
	 * Ставил ли пользователь like отзыву (есть ли в cookie)
	 *
	 * @return bool
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function liked()
	{
		$cookieVotes = \Request::cookie('productReviewVotes', []);
		return key_exists($this->id, $cookieVotes) && $cookieVotes[$this->id]['vote'] == ProductReview::LIKE
			? true : false;
	}

	/**
	 * Ставил ли пользователь dislike отзыву (есть ли в cookie)
	 *
	 * @return bool
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function disliked()
	{
		$cookieVotes = \Request::cookie('productReviewVotes', []);
		return key_exists($this->id, $cookieVotes) && $cookieVotes[$this->id]['vote'] == ProductReview::DISLIKE
			? true : false;
	}
}