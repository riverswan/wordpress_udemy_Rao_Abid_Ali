<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/riverswan/
 * @since      1.0.0
 *
 * @package    Rocket_Books
 * @subpackage Rocket_Books/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Rocket_Books
 * @subpackage Rocket_Books/includes
 * @author     Paul Swan <my@esad.com>
 */
class Rocket_Books_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		$plugin_post_types = new Rocket_Books_Post_Types( ROCKET_BOOKS_NAME, ROCKET_BOOKS_VERSION );
		$plugin_post_types->init();
		flush_rewrite_rules();
	}

}
