<?php
namespace Plugin\Frontend;

class Short_Code {
	const SHORT_CODE = 'falcon_weather';
	const PATH = 'falcon_weather';
	const UNIT_SYSTEM = 'metric';

	public function __construct() {
		add_shortcode( 'falcon_weather', array( $this, 'render_falcon_weather' ) );
	}

	public function enqueue_scripts_and_styles() {
		wp_enqueue_style( 'style.css', FRONTEND_PATH . '/assets/style.css' );
		wp_enqueue_script('jquery');
	}

	public function render_falcon_weather() {
		$weather_api = new Weather();
		$data = json_encode($weather_api->get_falcon_weather(self::UNIT_SYSTEM));
		require 'html/falcon-weather-short-code.php';
	}

	public function get_falcon_weather() {
		$weather_api = new Weather();
		wp_send_json($weather_api->get_falcon_weather(Short_Code::UNIT_SYSTEM));
	}
}