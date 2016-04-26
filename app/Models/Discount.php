<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Discount
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property float $value
 * @property boolean $type
 * @property string $date_start
 * @property string $date_end
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discount whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discount whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discount whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discount whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discount whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discount whereDateStart($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discount whereDateEnd($value)
 * @mixin \Eloquent
 */
class Discount extends Model
{
	protected $table = 'discounts';
	
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title',
		'description',
		'value',
		'type',
		'date_start',
		'date_end',
	];
}