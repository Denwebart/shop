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
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Property whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Property whereTitle($value)
 * @mixin \Eloquent
 */
class Property extends Model
{
	protected $table = 'properties';
	
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title',
	];

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