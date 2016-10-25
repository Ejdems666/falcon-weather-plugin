<?php
/**
 * Created by PhpStorm.
 * User: Ejdems
 * Date: 24/10/2016
 * Time: 19:23
 */

namespace Plugin\Frontend;

use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\CurrentWeather;
use Plugin\Admin\Settings;

class Weather_Api extends OpenWeatherMap {

	public function __construct() {
		$api_key = get_option(Settings::SLUG)['api_key'];
		parent::__construct( $api_key );
	}

	/**
	 * @return CurrentWeather[]
	 */
	public function get_falcon_weather($unit) {
		try {
			return $this->get_all_cities($unit);
		} catch(\Exception $e) {
			echo 'General exception: ' . $e->getMessage() . ' (Code ' . $e->getCode() . ').';
		}
	}

	private function get_all_cities($unit) {
		$cities = array('Berlin','Copenhagen','Budapest','New York');
		$data = array();
		foreach ( $cities as $city ) {
			$weather = $this->getWeather($city,$unit);
			$data[] = $weather;
		}
		return $data;
	}
}