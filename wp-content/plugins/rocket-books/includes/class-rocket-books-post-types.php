<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/riverswan/
 * @since      1.0.0
 *
 * @package    Rocket_Books
 * @subpackage Rocket_Books/public
 */

/**
 * Functionality for our custom post types
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Rocket_Books
 * @subpackage Rocket_Books/public
 * @author     Paul Swan <my@esad.com>
 */
class Rocket_Books_Post_Types {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	private $template_loader;

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
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name     = $plugin_name;
		$this->version         = $version;
		$this->template_loader = $this->get_template_loader();

	}

	public function init() {
		$this->register_book_post_type();
		$this->register_taxonomy_genre();
	}

	public function register_book_post_type() {
		register_post_type(
			'book',
			array(
				'description'          => __( 'Books', 'rocket-books' ),
				'labels'               => array(
					'name'               => _x( 'Books', 'post type general name', 'rocket-books' ),
					'singular_name'      => _x( 'Book', 'post type singular name', 'rocket-books' ),
					'menu_name'          => _x( 'Books', 'admin menu', 'rocket-books' ),
					'name_admin_bar'     => _x( 'Book', 'add new book on admin bar', 'rocket-books' ),
					'add_new'            => _x( 'Add New', 'post_type', 'rocket-books' ),
					'add_new_item'       => __( 'Add New Book', 'rocket-books' ),
					'edit_item'          => __( 'Edit Book', 'rocket-books' ),
					'new_item'           => __( 'New Book', 'rocket-books' ),
					'view_item'          => __( 'View Book', 'rocket-books' ),
					'search_items'       => __( 'Search Books', 'rocket-books' ),
					'not_found'          => __( 'No books found.', 'rocket-books' ),
					'not_found_in_trash' => __( 'No books found in Trash.', 'rocket-books' ),
					'parent_item_colon'  => __( 'Parent Book:', 'rocket-books' ),
					'all_items'          => __( 'All Books', 'rocket-books' ),
				),
				'public'               => true,
				'hierarchical'         => false,
				'exclude_from_search'  => false,
				'publicly_queryable'   => true,
				'show_ui'              => true,
				'show_in_menu'         => true,
				'show_in_nav_menus'    => true,
				'show_in_admin_bar'    => true,
				'menu_position'        => 20,
				'menu_icon'            => 'dashicons-welcome-learn-more',
				'capability_type'      => 'post',
				'capabilities'         => array(),
				'map_meta_cap'         => null,
				'supports'             => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
				'register_meta_box_cb' => array( $this, 'register_metabox_book' ),
				'taxonomies'           => array( 'genre' ),
				'has_archive'          => true,
				'rewrite'              => array(
					'slug'       => 'book',
					'with_front' => true,
					'feeds'      => true,
					'pages'      => true,
				),
				'query_var'            => true,
				'can_export'           => true,
				'show_in_rest'         => true,
			)
		);

	}

	public function register_taxonomy_genre() {
		register_taxonomy(
			'genre',
			array( 'book' ),
			array(
				'description'       => 'Genre',
				'labels'            => array(
					'name'                       => _x( 'Genre', 'taxonomy general name', 'rocket-books' ),
					'singular_name'              => _x( 'Genre', 'taxonomy singular name', 'rocket-books' ),
					'search_items'               => __( 'Search Genre', 'rocket-books' ),
					'popular_items'              => __( 'Popular Genre', 'rocket-books' ),
					'all_items'                  => __( 'All Genre', 'rocket-books' ),
					'parent_item'                => __( 'Parent Genre', 'rocket-books' ),
					'parent_item_colon'          => __( 'Parent Genre:', 'rocket-books' ),
					'edit_item'                  => __( 'Edit Genre', 'rocket-books' ),
					'view_item'                  => __( 'View Genre', 'rocket-books' ),
					'update_item'                => __( 'Update Genre', 'rocket-books' ),
					'add_new_item'               => __( 'Add New Genre', 'rocket-books' ),
					'new_item_name'              => __( 'New Genre Name', 'rocket-books' ),
					'separate_items_with_commas' => __( 'Separate genre with commas', 'rocket-books' ),
					'add_or_remove_items'        => __( 'Add or remove genre', 'rocket-books' ),
					'choose_from_most_used'      => __( 'Choose from the most used genre', 'rocket-books' ),
					'not_found'                  => __( 'No genre found.', 'rocket-books' ),
				),
				'public'            => true,
				'show_ui'           => true,
				'show_in_nav_menus' => true,
				'show_tagcloud'     => true,
				'meta_box_cb'       => null,
				'show_admin_column' => true,
				'hierarchical'      => true,
				'query_var'         => 'genre',
				'rewrite'           => array(
					'slug'         => 'genre',
					'with_front'   => true,
					'hierarchical' => true,
				),
				'capabilities'      => array(),
				'show_in_rest'      => true,
			)
		);
	}

	public function content_single_book( $the_content ) {
		if ( in_the_loop() && is_singular( 'book' ) ) {
			ob_start();
			include ROCKET_BOOKS_BASE_DIR . 'templates/book-content.php';

			return ob_get_clean();
		}

		return $the_content;
	}

	public function single_template_book( $template ) {
		if ( is_singular( 'book' ) ) {
			return $this->template_loader->get_template_part( 'single', 'book', false );

		}

		return $template;
	}

	public function archive_template_book( $template ) {
		if ( is_post_type_archive( 'book' ) || is_tax( 'genre' ) ) {

			return $this->template_loader->get_template_part( 'archive', 'book', false );

		}

		return $template;
	}

	public function get_template_loader() {
		require_once ROCKET_BOOKS_BASE_DIR . 'public/class-rocket-book-template-loader.php';

		return new Rocket_Books_Template_Loader();
	}

	public function register_metabox_book( $post ) {
		$is_gutenberg_active = use_block_editor_for_post_type( get_post_type() );
		add_meta_box(
			'book-details',
			__( 'Book details', 'rocket-books' ),
			array( $this, 'book_metabox_display_cb' ),
			'book',
			'side',
			'default'
		);
	}

	public function book_metabox_display_cb( $post ) {
		echo "here we display info \n";
	}
}