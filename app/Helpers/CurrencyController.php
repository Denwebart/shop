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
	public function getCourse($currency = 'USD')
	{
		$xml = $this->getXML();
		if($xml) {
			$result = $this->procXML($xml, $currency);
			\Cache::forever('course', $result);
			return $result;
		} else {
			return \Cache::get('course', false);
		}
	}
	
	private function getXML()
	{
		$url = 'http://www.cbr.ru/scripts/XML_daily.asp';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		return $result = curl_exec($ch);
	}

	private function procXML($xml, $currency)
	{
		$rates = new SimpleXMLElement($xml);
		
		foreach ($rates->Valute as $rate){
			if ($rate->CharCode == $currency){
				return (string) $rate->Value;
			}
		}
	}
}