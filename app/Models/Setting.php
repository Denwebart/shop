<?php
/**
 * App\Models\Setting
 *
 * @property integer $id
 * @property string $key
 * @property integer $type
 * @property integer $category
 * @property string $title
 * @property string $description
 * @property string $value
 * @property boolean $is_active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereIsActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereUpdatedAt($value)
 * @mixin \Eloquent
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
