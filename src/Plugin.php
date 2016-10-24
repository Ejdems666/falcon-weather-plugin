<?php
/**
 * Created by PhpStorm.
 * User: Ejdems
 * Date: 24/10/2016
 * Time: 13:24
 */
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
		$this->init_admin_hooks();
		$short_code = new Short_Code();
		$this->hook_loader->run();
	}

	private function init_admin_hooks() {
		$settings = new Settings;
		$this->hook_loader->add_action( 'admin_init', $settings, 'settings_init' );
		$this->hook_loader->add_action( 'admin_menu', $settings, 'add_settings_page' );
	}
}