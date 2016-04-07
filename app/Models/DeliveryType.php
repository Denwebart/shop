<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 * 
 * App\Models\DeliveryType
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeliveryType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeliveryType whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeliveryType whereDescription($value)
 * @mixin \Eloquent
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryType extends Model
{
	protected $table = 'delivery_types';

	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'title',
		'description',
	];
}