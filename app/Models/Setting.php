<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Setting
 *
 * @property integer $id
 * @property string $key
 * @property boolean $category
 * @property boolean $type
 * @property string $title
 * @property string $description
 * @property string $value
 * @property boolean $is_active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereIsActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Setting extends Model
{
	protected $table = 'settings';

	/**
	 * Тип настройки (значение поля type)
	 */
	const TYPE_BOOLEAN = 1;
	const TYPE_INTEGER = 2;
	const TYPE_TEXT    = 3;
	const TYPE_HTML    = 4;

	public static $types = [
		self::TYPE_BOOLEAN => 'Логическое значение',
		self::TYPE_INTEGER => 'Целое число',
		self::TYPE_TEXT    => 'Короткий текст',
		self::TYPE_HTML    => 'HTML-код',
	];

	/**
	 * Статус публикации (значение поля is_active)
	 */
	const INACTIVE = 0;
	const ACTIVE   = 1;

	public static $is_published = [
		self::INACTIVE => 'Включена',
		self::ACTIVE   => 'Отключена',
	];

	/**
	 * Категория настройки (значение поля category)
	 */
	const CATEGORY_SITE = 1;

	public static $categories = [
		self::CATEGORY_SITE => 'Общие настройки',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'value',
		'is_active',
	];

}
