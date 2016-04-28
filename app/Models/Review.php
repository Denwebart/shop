<?php
/**
 * Class Review
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use App\Helpers\Translit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

/**
 * App\Models\Review
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property boolean $is_published
 * @property string $user_name
 * @property string $user_email
 * @property string $user_avatar
 * @property string $text
 * @property string $published_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review whereIsPublished($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review whereUserName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review whereUserEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review whereUserAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review wherePublishedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review whereUpdatedAt($value)
 */
class Review extends Model
{
	protected $table = 'reviews';

	protected $imagePath = '/uploads/reviews/';
	
	/**
	 * Статус публикации (значение поля is_published)
	 */
	const UNPUBLISHED = 0;
	const PUBLISHED   = 1;
	
	public static $is_published = [
		self::UNPUBLISHED => 'Не опубликован',
		self::PUBLISHED   => 'Опубликован',
	];
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'is_published',
		'published_at',
		'user_name',
		'user_email',
		'user_avatar',
		'text',
	];
	
	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected static $rules = [
		'is_published' => 'boolean',
		'user_name' => 'required|max:100',
		'user_email' => 'email|max:100',
		'user_avatar' => 'image|max:3072',
		'text' => 'required|max:1000',
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
	 * Get image url
	 *
	 * @param bool $default
	 * @return string
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getUserAvatarUrl($default = true) {
		return $this->user_avatar
			? url($this->imagePath . $this->id . '/' . $this->user_avatar)
			: ($default
				? url('images/default-avatar.jpg')
				: '');
	}

	/**
	 * Image uploading
	 *
	 * @param Request $request
	 * @return bool
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function setImage(Request $request)
	{
		$postImage = $request->file('user_avatar');
		if (isset($postImage)) {
			$fileName = Translit::generateFileName($postImage->getClientOriginalName());
			$imagePath = public_path() . $this->imagePath . $this->id . '/';
			$image = Image::make($postImage->getRealPath());
			File::exists($imagePath) or File::makeDirectory($imagePath, 0755, true);
			
			// delete old image
			$this->deleteImage();
			
			$image->save($imagePath . 'origin_' . $fileName);
			
			$cropSize = ($image->width() < $image->height()) ? $image->width() : $image->height();
			$image->crop($cropSize, $cropSize)
				->resize(128, null, function ($constraint) {
					$constraint->aspectRatio();
				})->save($imagePath . $fileName);
			
			$this->user_avatar = $fileName;
			return true;
		} else {
			if($request->get('deleteImage')) {
				$this->deleteImage();
				return true;
			}
			return false;
		}
	}
	
	/**
	 * Delete old image
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function deleteImage()
	{
		$imagePath = public_path() . $this->imagePath . $this->id . '/';
		// delete old image
		if(File::exists($imagePath . $this->user_avatar)) {
			File::delete($imagePath . $this->user_avatar);
		}
		if(File::exists($imagePath . 'origin_' . $this->image)) {
			File::delete($imagePath . 'origin_' . $this->image);
		}
		$this->user_avatar = null;
	}
}