<?php
/**
 * Class Date
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Helpers;

class Date
{
	protected static $months = [
		'1' => 'января',
		'2' => 'февраля',
		'3' => 'марта',
		'4' => 'апреля',
		'5' => 'мая',
		'6' => 'июня',
		'7' => 'июля',
		'8' => 'августа',
		'9' => 'сентября',
		'10' => 'октября',
		'11' => 'ноября',
		'12' => 'декабря',
	];

	protected static $shortMonths = [
		'1' => 'янв.',
		'2' => 'февр.',
		'3' => 'марта',
		'4' => 'апр.',
		'5' => 'мая',
		'6' => 'июня',
		'7' => 'июля',
		'8' => 'авг.',
		'9' => 'сент.',
		'10' => 'окт.',
		'11' => 'нояб.',
		'12' => 'дек.',
	];

	/**
	 * Формат даты для всего сайта
	 *
	 * @param string $date Дата
	 * @param bool $withTime Если нужно время
	 * @param bool $isShortMonth Месяц сокращен
	 * @return string
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function format($date, $withTime = false, $isShortMonth = false)
	{
		if(!is_null($date)) {
			$timestamp = strtotime($date);
			$month = ($isShortMonth) ?
				self::$shortMonths[date('n', $timestamp)] : self::$months[date('n', $timestamp)];
			$time = ($withTime) ? " H:i" : "";
			return date("j $month Y" . $time, $timestamp);
		} else {
			return '-';
		}
	}

	/**
	 * Время в формате "1 мин. наазд" и т.д
	 *
	 * @param string $date Дата
	 * @return string
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function getRelative($date)
	{
		$timestamp = strtotime($date);
		$delta = (time() - $timestamp);
		if ($delta < 0) {
			return '0 сек.';
		}
		if ($delta < 60) {
			$result = round($delta, 0) . ' сек. назад';
		} elseif ($delta < 120) {
			$result = '1 мин. назад';
		} elseif ($delta < (45 * 60)) {
			$result = round(($delta / 60), 0) . ' мин. назад';
		} elseif ($delta < (24 * 60 * 60)) {
			$result = 'сегодня в ' . date('H:i', $timestamp);
		} else {
			$date = date('Y', $timestamp) != date('Y') ? ' ' . date('Y', $timestamp) : '';
			$result = date('j', $timestamp) . ' ' . self::$months[date('n', $timestamp)]
				. $date
				. ' в ' . date('H:i', strtotime($date));
		}

		return $result;
	}
}