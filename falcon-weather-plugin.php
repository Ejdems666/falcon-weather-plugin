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
if ( ! defined( 'WPINC' ) ) {
	die;
}

require 'autoloader.php';

$plugin = new Falcon_Weather_Plugin();
$plugin->run();