<?php
namespace Plugin\Admin;

use Plugin\Plugin;

class Settings {
	const SLUG = Plugin::SLUG . '_settings';

	private $default_data = array(
		'api_key' => 'b854f1de628b21e5117fab832b96a465'
	);

	public function __construct() {
		register_activation_hook( MAIN_FILE_PATH, array( $this, 'activate_default_data' ) );
	}

	public function activate_default_data() {
		update_option( Settings::SLUG, $this->default_data );
	}

	public function settings_init() {
		register_setting( Settings::SLUG, Settings::SLUG, array( $this, 'validate' ) );
	}

	public function validate( $input ) {
		$valid_data            = array();
		$valid_data['api_key'] = sanitize_text_field( $input['api_key'] );
		if ( ! $valid_data['api_key'] ) {
			add_settings_error(
				'api_key',
				'api_key_error',
				'Please enter your OpenWeather Api key',
				'error'
			);
			$valid_data['api_key'] = $this->default_data['api_key'];
		}

		return $valid_data;
	}

	public function add_settings_page() {
		add_options_page(
			'Falcon Weather',
			'Falcon Weather',
			'manage_options',
			Settings::SLUG,
			array( $this, 'render_settings_page' )
		);
	}

	public function render_settings_page() {
		$option_name = Settings::SLUG;
		$api_key     = get_option( $option_name )['api_key'];
		require __DIR__ . '/html/settings-page.php';
	}
}
