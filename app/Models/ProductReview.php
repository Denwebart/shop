<?php

/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 *
 * App\Models\ProductReview
 *
 * @mixin \Eloquent
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
	protected $table = 'products_reviews';

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
	];

	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected static $rules = [
		'user_id' => 'required_without_all:user_name,user_email|integer',
		'product_id' => 'integer',
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
}