<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyValue extends Model
{
	protected $table = 'properties_values';

	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'property_id',
		'value',
	];
}