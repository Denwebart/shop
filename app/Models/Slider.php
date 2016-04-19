<?php
/**
 * App\Models\Page
 *
 * @property integer $id
 * @property string $alias
 * @property integer $parent_id
 * @property integer $user_id
 * @property boolean $type
 * @property boolean $is_published
 * @property boolean $is_container
 * @property string $title
 * @property string $menu_title
 * @property string $image
 * @property string $image_alt
 * @property string $introtext
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $published_at
 * @property string $meta_title
 * @property string $meta_desc
 * @property string $meta_key
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereAlias($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereIsPublished($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereIsContainer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereMenuTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereImageAlt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereIntrotext($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page wherePublishedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereMetaTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereMetaDesc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereMetaKey($value)
 * @mixin \Eloquent
 */

namespace App\Models;

use App\Helpers\Translit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class Slider extends Model
{
	protected $table = 'slider';

	protected $imagePath = '/uploads/slider/';

	public $timestamps = false;

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
		'id',
		'image',
		'image_alt',
		'title',
		'text_1',
		'text_2',
		'is_published',
		'button_text',
		'button_link',
	];

	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected static $rules = [
		'id' => '',
		'image' => 'required|image|max:10240',
		'image_alt' => 'max:350',
		'title' => 'max:250',
		'text_1' => 'max:250',
		'text_2' => 'max:250',
		'is_published' => 'boolean',
		'button_text' => 'max:100',
		'button_link' => 'url|max:250',
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
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getImageUrl()
	{
		return $this->image ? asset($this->imagePath . $this->id . '/' . $this->image) : '';
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
			$imagePath = public_path() . $this->imagePath . $this->id . '/';
			$image = Image::make($postImage->getRealPath());
			File::exists($imagePath) or File::makeDirectory($imagePath, 0755, true);

			// delete old image
			$this->deleteImage();

			$image->save($imagePath . 'origin_' . $fileName);

			if ($image->width() > 760) {
				$image->resize(760, null, function ($constraint) {
					$constraint->aspectRatio();
				})->save($imagePath . $fileName);
			} else {
				$image->save($imagePath . $fileName);
			}

			$this->image = $fileName;
			return true;
		} else {
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
		if(File::exists($imagePath . $this->image)) {
			File::delete($imagePath . $this->image);
		}
		if(File::exists($imagePath . 'origin_' . $this->image)) {
			File::delete($imagePath . 'origin_' . $this->image);
		}
		$this->image = null;
	}
}
