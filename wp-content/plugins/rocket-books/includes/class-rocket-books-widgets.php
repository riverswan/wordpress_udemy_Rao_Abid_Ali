<?php declare( strict_types=1 );

/**
 * Controlling all the widgets
 *
 * @package    Rocket_Books
 * @subpackage Rocket_Books/includes
 * @author     Rao <rao@booskills.com>
 */
if ( ! class_exists( 'Rocket_Books_Widgets ' ) ) {

	class Rocket_Books_Widgets {

		/**
		 * The ID of this plugin.
		 *
		 * @since    1.0.0
		 * @access   private
		 * @var      string $plugin_name The ID of this plugin.
		 */
		private $plugin_name;

		/**
		 * The version of this plugin.
		 *
		 * @since    1.0.0
		 * @access   private
		 * @var      string $version The current version of this plugin.
		 */
		private $version;

		/**
		 * Initialize the class and set its properties.
		 *
		 * @param string $plugin_name The name of the plugin.
		 * @param string $version The version of this plugin.
		 *
		 * @since    1.0.0
		 *
		 */
		public function __construct( $plugin_name, $version ) {
			$this->plugin_name = $plugin_name;
			$this->version     = $version;
			$this->load_dependency();
		}

		public function register_widgets() {
			require_once ROCKET_BOOKS_BASE_DIR . 'includes/widgets/class-rocket-books-widgets-books-list.php';
			register_widget( 'Rocket_Books_Widgets_Books_List' );
			require_once ROCKET_BOOKS_BASE_DIR . 'includes/widgets/class-rocket-books-widgets-featured-book.php';
			register_widget( 'Rocket_Books_Widgets_Featured_Book' );
		}

		public function load_dependency() {
			require_once ROCKET_BOOKS_BASE_DIR . 'vendor/boo-widget-helper/class-boo-widget-helper.php';
		}
	}
}

