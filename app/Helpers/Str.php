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

	/**
	 * Формат номера телефона
	 *
	 * @param $phone
	 * @return string
	 */
	public static function phoneFormat($phone)
	{
		$number = preg_replace("/[^0-9]/", "", $phone);
		if($number) {
			$phone = substr_replace($number, '-', -2, -2);
			$phone = substr_replace($phone, '-', -5, -5);
			$phone = substr_replace($phone, ') ', -9, -9);
			$phone = substr_replace($phone, ' (', -14, -14);

			if($number[0] == 3 || $number[0] == 7) {
				$phone = substr_replace($phone, '+', 0, 0);
			}
		} else {
			$phone = '-';
		}

		return $phone;
	}

	/**
	 * Формат цены
	 *
	 * @param $price
	 * @return string
	 */
	public static function priceFormat($price)
	{
		$afterPoint = 0;
		$currency = ' руб.';
		return number_format($price, $afterPoint, '.', ' ') . $currency;
	}
}