<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
		'id',
		'title',
		'description',
		'value',
		'type',
		'date_start',
		'date_end',
	];
}