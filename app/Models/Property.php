<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Property
 *
 * @property integer $id
 * @property string $title
 * @property boolean $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PropertyValue[] $values
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Property whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Property whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Property whereType($value)
 * @mixin \Eloquent
 */
class Property extends Model
{
	protected $table = 'properties';
	
	public $timestamps = false;

	public $productsCount = 0;
	
	/**
	 * Тип (значение поля type)
	 */
	const TYPE_DEFAULT = 0;
	const TYPE_COLOR   = 1;
	const TYPE_TAG     = 2;
	const TYPE_BRAND   = 3;
	const TYPE_SIZE    = 4;

	public static $types = [
		self::TYPE_DEFAULT => 'Стандартная',
		self::TYPE_COLOR   => 'Цвет',
		self::TYPE_TAG     => 'Тег',
		self::TYPE_BRAND   => 'Бренд',
		self::TYPE_SIZE    => 'Размер',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title',
		'type',
	];

	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static $rules = [
		'title' => 'required|max:50',
		'type' => 'integer|between:0,4',
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

		static::deleting(function($property) {
			$property->values()->delete();
		});
	}

	/**
	 * Values
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function values()
	{
		return $this->hasMany('App\Models\PropertyValue', 'property_id');
	}
}