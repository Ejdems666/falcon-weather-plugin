<?php
namespace Plugin;

use Plugin\Admin\Settings;
use Plugin\Frontend\Short_Code;

class Plugin {
	const SLUG = 'falcon-weather-plugin';

	/** @var Hook_Loader */
	private $hook_loader;
	private $version = '1.0';

	public function get_version() {
		return $this->version;
	}

	public function __construct() {
		$this->hook_loader = new Hook_Loader();
	}

	public function run() {
		$this->set_admin_hooks();
		$this->set_short_code_hooks();
		$this->hook_loader->run();
	}

	private function set_admin_hooks() {
		$settings = new Settings();
		$this->hook_loader->add_action( 'admin_init', $settings, 'settings_init' );
		$this->hook_loader->add_action( 'admin_menu', $settings, 'add_settings_page' );
	}

	private function set_short_code_hooks() {
		$short_code = new Short_Code();
		$this->hook_loader->add_action( 'wp_enqueue_scripts', $short_code, 'enqueue_scripts_and_styles' );
		$this->hook_loader->add_action( 'wp_ajax_falcon_weather', $short_code, 'get_falcon_weather' );
	}
}