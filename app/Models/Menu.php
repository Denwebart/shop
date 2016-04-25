<?php

namespace App\Models;

use App\Helpers\Translit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class Menu extends Model
{
	protected $table = 'menus';

	public $timestamps = false;

	/**
	 * Тип меню (значение поля type)
	 */
	const TYPE_PRODUCT      = 1;
	const TYPE_MAIN         = 2;
	const TYPE_BOTTOM_LEFT  = 3;
	const TYPE_BOTTOM_RIGHT = 4;
	const TYPE_INFO         = 5;

	public static $types = [
		self::TYPE_PRODUCT      => 'Главное меню',
		self::TYPE_MAIN         => 'Верхнее меню',
		self::TYPE_BOTTOM_LEFT  => 'Нижнее меню (справа)',
		self::TYPE_BOTTOM_RIGHT => 'Нижнее меню (слева)',
		self::TYPE_INFO         => 'Информационное меню',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'parent_id',
		'page_id',
		'type',
		'position',
	];

	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected static $rules = [
		'parent_id' => 'integer',
		'page_id' => 'required|integer',
		'type' => 'integer|min:1|max:3',
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
	 * Страница
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function page()
	{
		return $this->belongsTo('App\Models\Page', 'page_id');
	}

	/**
	 * Родительский пункт меню
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function parent()
	{
		return $this->belongsTo('App\Models\Menu', 'parent_id');
	}

	/**
	 * Дочерние пункты меню
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function children()
	{
		return $this->hasMany('App\Models\Menu', 'parent_id');
	}

}
