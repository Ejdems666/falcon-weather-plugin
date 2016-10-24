<?php
/**
 * Created by PhpStorm.
 * User: Ejdems
 * Date: 24/10/2016
 * Time: 13:25
 */
namespace Plugin;

class Hook_Loader {
	protected $actions = array();
	protected $filters = array();

	public function add_action($hook, $component, $callback ) {
		$this->actions[] = $this->compose_hook($hook, $component, $callback );
	}

	public function add_filter($hook, $component, $callback ) {
		$this->filters[] = $this->compose_hook($hook, $component, $callback );
	}
	private function compose_hook($hookName, $component, $callback ) {
		$hook = array(
			'hook'      => $hookName,
			'component' => $component,
			'callback'  => $callback
		);
		return $hook;
	}

	public function run() {

		foreach ( $this->filters as $hook ) {
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ) );
		}

		foreach ( $this->actions as $hook ) {
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ) );
		}

	}
}