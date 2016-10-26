<?php
/**
 * Created by PhpStorm.
 * User: Ejdems
 * Date: 24/10/2016
 * Time: 19:29
 */

namespace Plugin\Frontend;


use Cmfcmf\OpenWeatherMap\Util\Temperature;
use Cmfcmf\OpenWeatherMap\Util\Wind;

class Short_Code {
	const SHORT_CODE = 'falcon_weather';
	const PATH = 'falcon_weather';
	const UNIT = 'metric';
	private $unitMapper = array(
		'metric' => array(
			'wind' => array('low' => 5, 'medium' => 10),
			'temperature' => array('low' => 0, 'medium' => 25)
		)
	);
	private $weather_api;

	public function __construct() {
		$this->weather_api = new Weather_Api();
		add_shortcode( 'falcon_weather', array( $this, 'render_falcon_weather' ) );
	}

	public function enqueue_styles() {
		wp_enqueue_style( 'style.css', FRONTEND_PATH . '/assets/style.css' );
	}

	public function render_falcon_weather() {
		$cities = $this->weather_api->get_falcon_weather(self::UNIT);

		require 'html/falcon-weather-short-code.php';
	}

	public function getWindIcon( Wind $wind ) {
		$icon = $this->getIcon('wind',$wind->speed->getValue());
		$class = '';
		if(strpos($wind->direction->getFormatted(),'W')) {
			$class = 'class="flip"';
		}
		return '<img src="'.FRONTEND_PATH.'/assets/icons/'.$icon.'" alt="wind" '.$class.' title="'.$wind->direction.'">';
	}
	public function getTemperatureIcon( Temperature $temperature ) {
		$icon = $this->getIcon('temperature',$temperature->now->getValue());
		return '<img src="'.FRONTEND_PATH.'/assets/icons/'.$icon.'" alt="temperature">';
	}
	private function getIcon($type,$actualValue) {
		foreach ($this->unitMapper[self::UNIT][$type] as $key => $measurement) {
			if($actualValue < $measurement) {
				return $type.'-'.$key.'.svg';
			}
		}
		return $type.'-high.svg';
	}
}