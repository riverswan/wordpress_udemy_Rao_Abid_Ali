<?php declare( strict_types=1 );

if ( ! class_exists( 'Rocket_Books_Template_Loader' ) ) {
	if (! class_exists( 'Gamajo_Template_Loader' ) ) {
		require_once ROCKET_BOOKS_BASE_DIR . 'vendor/class-gamajo-template-loader.php';
	}

	class Rocket_Books_Template_Loader extends Gamajo_Template_Loader {
		protected $filter_prefix             = 'rocket-books';
		protected $theme_template_directory  = 'rocket-books';
		protected $plugin_directory          = ROCKET_BOOKS_BASE_DIR;
		protected $plugin_template_directory = 'templates';

	}
}
