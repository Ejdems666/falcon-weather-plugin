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
	const PATH = 'falcon_weather';
	private $weather_api;

	public function __construct() {
		$this->weather_api = new Weather_Api();
		wp_enqueue_style('style.css',FRONTEND_PATH.'/assets/style.css');
		add_shortcode( 'falcon_weather', array( $this, 'render_falcon_weather' ) );
	}

	public function render_falcon_weather() {
		$cities = $this->weather_api->get_falcon_weather();

		require 'html/falcon_weather.php';
	}
}