<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Letter
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $message
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Letter whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Letter whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Letter whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Letter whereSubject($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Letter whereMessage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Letter whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Letter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Letter extends Model
{
	protected $table = 'letters';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'subject',
		'message',
		'updated_at',
	];

	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static $rules = [
		'name' => 'required|max:50|regex:/^[A-Za-zА-Яа-яЁёЇїІіЄє \-\']+$/u',
		'email' => 'required|email|max:255',
		'subject' => 'max:250',
		'message' => 'required',
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
}