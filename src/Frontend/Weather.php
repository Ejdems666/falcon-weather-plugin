<?php

namespace Plugin\Frontend;

use Cmfcmf\OpenWeatherMap;
use Plugin\Admin\Settings;

class Weather extends OpenWeatherMap {

	private $data = array( 'data' );

	public function __construct() {
		$api_key = get_option( Settings::SLUG )['api_key'];
		parent::__construct( $api_key );
	}

	public function get_falcon_weather( $unit_system ) {
		try {
			$this->data['data']['unit_system'] = $unit_system;
			$this->load_all_cities();
		} catch ( \Exception $e ) {
			$this->data['error']['message'] = $e->getMessage();
			$this->data['error']['code']    = $e->getCode();
		} finally {
			return $this->data;
		}
	}

	private function load_all_cities() {
		$cities = array( 'Berlin', 'Copenhagen', 'Budapest', 'New York' );

		foreach ( $cities as $key => $city ) {
			$weather                                                        = $this->getWeather( $city, $this->data['data']['unit_system'] );
			$this->data['data']['cities'][ $key ]['city']                   = $city;
			$this->data['data']['cities'][ $key ]['temperature']['value']   = $weather->temperature->now->getValue();
			$this->data['data']['cities'][ $key ]['temperature']['unit']    = $weather->temperature->getUnit();
			$this->data['data']['cities'][ $key ]['weather']['description'] = $weather->weather->description;
			$this->data['data']['cities'][ $key ]['weather']['icon']        = $weather->weather->icon;
			$this->data['data']['cities'][ $key ]['wind']['speed']          = $weather->wind->speed->getFormatted();
			$this->data['data']['cities'][ $key ]['wind']['direction']      = $weather->wind->direction->getFormatted();
		}
	}
}