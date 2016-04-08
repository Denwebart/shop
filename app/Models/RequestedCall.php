<?php
/**
 * Class RequestedCall
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 *
 * App\Models\RequestedCall
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $phone
 * @property integer $status
 * @property string $comment
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RequestedCall whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RequestedCall whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RequestedCall whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RequestedCall wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RequestedCall whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RequestedCall whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RequestedCall whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RequestedCall whereUpdatedAt($value)
 * @mixin \Eloquent
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestedCall extends Model
{
	protected $table = 'requested_calls';
	
	const STATUS_PHONED     = 1;
	const STATUS_NOT_PHONED = 2;
	
	public static $statuses = [
		self::STATUS_PHONED     => 'дозвонились',
		self::STATUS_NOT_PHONED => 'не дозвонились',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'product_id',
		'property_value_id',
	];


}