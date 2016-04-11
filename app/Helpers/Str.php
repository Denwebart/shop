<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Helpers;

class Str
{
	/**
	 * Обрезка фрагмента текста до пробела с учетом кодировки
	 *
	 * @param $html
	 * @param $size
	 * @param $end
	 * @return string
	 */
	public static function limit($html, $size, $end = '...')
	{
		if(mb_strlen($html) > $size) {
			$string = strip_tags($html);
			return mb_substr($string, 0, mb_strrpos(mb_substr($string, 0, $size,'utf-8'),' ', 'utf-8'),'utf-8') . $end;
		} else {
			return strip_tags($html);
		}
	}
}