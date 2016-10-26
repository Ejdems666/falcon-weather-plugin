<?php
/*
Plugin Name: Falcon Weather Plugin
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Showing weather information from cities where Falcon has offices.
Version: 1.0
Author: Adam Becvar
Author URI: http://adambecvar.cz
License: A "Slug" license name e.g. GPL2
*/
use Plugin\Plugin;

if ( ! defined( 'WPINC' ) ) {
	die;
}

require __DIR__ . '/vendor/autoload.php';
define( 'MAIN_FILE_PATH', __FILE__ );
define( 'ASSETS_PATH', ($_SERVER['REQUEST_URI'] != '/' ? $_SERVER['REQUEST_URI'] : '') . '/wp-content/plugins/falcon-weather-plugin/src/Frontend/assets' );
define( 'PLUGIN_PATH', plugin_dir_url( __FILE__ ) );

$plugin = new Plugin();
$plugin->run();