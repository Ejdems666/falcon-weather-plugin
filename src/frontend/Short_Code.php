<?php
/**
 * Created by PhpStorm.
 * User: Ejdems
 * Date: 24/10/2016
 * Time: 19:29
 */

namespace Plugin\Frontend;


class Short_Code {
	const SHORT_CODE = 'falcon_weather';
	private $weather_api;

	public function __construct() {
		$this->weather_api = new Weather_Api();
		add_shortcode( 'falcon_weather', array( $this, 'render_falcon_weather' ) );
	}

	public function render_falcon_weather() {
		$weather = $this->weather_api->get_falcon_weather();
		require 'html/falcon_weather.php';
	}
}