<?php
/**
 * Created by PhpStorm.
 * User: Ejdems
 * Date: 24/10/2016
 * Time: 13:24
 */
namespace Plugin;

class Plugin {
	private $hood_loader;

	public function __construct() {
		$this->hood_loader = new Hook_Loader();
	}

	public function run() {

	}
}