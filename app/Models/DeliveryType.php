<?php
/**
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
 * App\Models\DeliveryType
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $is_active
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeliveryType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeliveryType whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeliveryType whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeliveryType whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeliveryType whereIsActive($value)
 * @mixin \Eloquent
 */
class DeliveryType extends Model
{
	protected $table = 'delivery_types';

	protected $imagePath = '/uploads/delivery/';

	public $timestamps = false;

	/**
	 * Статус публикации (значение поля is_active)
	 */
	const INACTIVE = 0;
	const ACTIVE   = 1;

	public static $is_active = [
		self::INACTIVE => 'Отключен',
		self::ACTIVE   => 'Включен',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title',
		'description',
		'image',
		'is_active',
	];

	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static $rules = [
		'is_active' => 'boolean',
		'title' => 'required|max:50',
		'description' => 'max:250',
		'image' => 'image|max:3072'
	];

	/**
	 * Get validation rules for current setting
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

	public static function getDeliveryTypes()
	{
		return self::whereIsActive(1)->pluck('title', 'id')->toArray();
	}

	/**
	 * Get image url
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getImageUrl()
	{
		return $this->image ? asset($this->imagePath . $this->id . '/' . $this->image) : '';
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
		// доделать ресайз (в зависимости от дизайна)
		$postImage = $request->file('image');
		if($postImage) {
			$data['image'] = $postImage;
			$imagePath = $this->getImagesPath();

			$validator = \Validator::make($data, $this->getRules('image'));

			if ($validator->fails())
			{
				return \Response::json([
					'success' => false,
					'error' => $validator->errors()->first('image'),
					'message' => 'Изображение не загружено. Исправьте ошибки валидации.'
				]);
			}

			$this->deleteImage();

			$fileName = Translit::generateFileName($postImage->getClientOriginalName());
			$image = Image::make($postImage->getRealPath());
			File::exists($imagePath) or File::makeDirectory($imagePath, 0755, true);

			$image->save($imagePath . $fileName);
			$this->image = $fileName;
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Delete image with folder
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function deleteImage()
	{
		if (File::exists($this->getImagesPath() . $this->image)) {
			File::delete($this->getImagesPath() . $this->image);
		}
		File::deleteDirectory($this->getImagesPath());
	}
}