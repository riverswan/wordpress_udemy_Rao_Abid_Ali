<?php declare( strict_types=1 );


if ( ! class_exists( 'Rocket_Books_Global' ) ) {

	class Rocket_Books_Global {

		protected static $template_loader;

		public static function template_loader() {
			if ( empty( self::$template_loader ) ) {
				self::set_template_loader();
			}

			return self::$template_loader;
		}

		protected static function set_template_loader() {
			require_once ROCKET_BOOKS_BASE_DIR . 'public/class-rocket-book-template-loader.php';

			self::$template_loader = new Rocket_Books_Template_Loader();
		}
	}
}

