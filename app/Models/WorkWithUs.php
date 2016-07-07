<?php
/**
 * Class WorkWithUs
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
 * App\Models\WorkWithUs
 *
 * @property integer $id
 * @property boolean $is_published
 * @property string $title
 * @property string $image
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $published_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WorkWithUs whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WorkWithUs whereIsPublished($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WorkWithUs whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WorkWithUs whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WorkWithUs whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WorkWithUs whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WorkWithUs wherePublishedAt($value)
 * @mixin \Eloquent
 */
class WorkWithUs extends Model
{
	protected $table = 'work_with_us';

	protected $imagePath = '/uploads/workwithus/';
	
	/**
	 * Статус публикации (значение поля is_published)
	 */
	const UNPUBLISHED = 0;
	const PUBLISHED   = 1;
	
	public static $is_published = [
		self::UNPUBLISHED => 'Не опубликовано',
		self::PUBLISHED   => 'Опубликовано',
	];
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'is_published',
		'published_at',
		'title',
		'image',
	];
	
	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected static $rules = [
		'is_published' => 'boolean',
		'title' => 'required|max:500',
		'image' => 'required|image|max:3072',
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
	 * Get validation rules for current field
	 *
	 * @param null $attribute
	 * @return array|mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getRules($attribute = null)
	{
		if($attribute) {
			return [$attribute => self::$rules[$attribute]];
		}
		return self::$rules;
	}

	public static function boot()
	{
		parent::boot();

		static::deleting(function($model) {
			$model->deleteImagesFolder();
		});
	}

	/**
	 * Get image url
	 *
	 * @return string
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getImageUrl() {
		return $this->image ? url($this->imagePath . $this->id . '/' . $this->image) : '';
	}

	/**
	 * Get image path
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getImagesPath()
	{
		return public_path() . $this->imagePath . $this->id . '/';
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
		$postImage = $request->file('image');
		if (isset($postImage)) {
			$fileName = Translit::generateFileName($postImage->getClientOriginalName());
			$imagePath = $this->getImagesPath();
			$image = Image::make($postImage->getRealPath());
			File::exists($imagePath) or File::makeDirectory($imagePath, 0755, true);
			
			// delete old image
			$this->deleteImage();
			
			$image->save($imagePath . 'origin_' . $fileName);
			
			if ($image->width() > 152 && $image->height() > 94 && ($image->width() / 1.62) < $image->height()) {
				$image->resize(152, null, function ($constraint) {
					$constraint->aspectRatio();
				})->crop(152, 94)->save($imagePath . $fileName);
			} else {
				$image->save($imagePath . $fileName);
			}

			$this->image = $fileName;
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
		if(File::exists($this->getImagesPath() . $this->image)) {
			File::delete($this->getImagesPath() . $this->image);
		}
		$this->image = null;
	}

	/**
	 * Delete image folder
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function deleteImagesFolder()
	{
		File::deleteDirectory($this->getImagesPath());
	}
}