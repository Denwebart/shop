<?php
/**
 * Class CurrencyController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */


namespace App\Helpers;

use App\Helpers\CurrencyRate;
use SimpleXMLElement;

class CurrencyController implements CurrencyRate
{
	/**
	 * Getting exchange rates
	 *
	 * @param string $currency
	 * @return float|int|mixed|string
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getCourse($currency = 'USD')
	{
		$xml = $this->getXML();
		if($xml) {
			if(\Config::get('checkout.defaultCurrency.code') == 'RUB') {
				$result = $this->procXMLfromCBR($xml, $currency);
			} elseif(\Config::get('checkout.defaultCurrency.code') == 'UAH') {
				$result = $this->procXMLfromNBU($xml, $currency);
			}
			if(is_null($result)) $result = 1;
			$result = floatval(str_replace(',', '.', $result));
			\Cache::forever('course' . $currency, $result);
			return $result;
		} else {
			return \Cache::get('course' . $currency, false);
		}
	}

	/**
	 * Get Api Url
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	private function getApiUrl()
	{
		if(\Config::get('checkout.defaultCurrency.code') == 'RUB') {
			$url = 'http://www.cbr.ru/scripts/XML_daily.asp';
		} elseif(\Config::get('checkout.defaultCurrency.code') == 'UAH') {
			$url = 'bank.gov.ua/NBUStatService/v1/statdirectory/exchange';
		}
		return isset($url) ? $url : false;
	}

	/**
	 * Get cours
	 *
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	private function getXML()
	{
		$url = $this->getApiUrl();

		if(isset($url)) {
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$result = curl_exec($ch);

			curl_close($ch);
			unset($ch);
		}

		return isset($result) ? $result : false;
	}

	/**
	 * Parse XML from CBR
	 *
	 * @param $xml
	 * @param $currency
	 * @return string
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	private function procXMLfromCBR($xml, $currency)
	{
		$rates = new SimpleXMLElement($xml);

		foreach ($rates->Valute as $rate){
			if ($rate->CharCode == $currency){
				return (string) $rate->Value;
			}
		}
	}

	/**
	 * Parse XML from NBU
	 *
	 * @param $xml
	 * @param $currency
	 * @return string
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	private function procXMLfromNBU($xml, $currency)
	{
		$rates = new SimpleXMLElement($xml);

		foreach ($rates->currency as $rate){
			if ($rate->cc == $currency){
				return (string) $rate->rate;
			}
		}
	}
}