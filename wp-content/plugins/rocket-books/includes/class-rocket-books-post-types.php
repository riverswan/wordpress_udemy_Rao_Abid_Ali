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
		$this->template_loader = rbr_get_template_loader();

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
				//              'register_meta_box_cb' => array( $this, 'register_metabox_book' ),
				'register_meta_box_cb' => null,
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
		if ( is_archive_book() ) {

			return $this->template_loader->get_template_part( 'archive', 'book', false );

		}

		return $template;
	}

	public function register_metabox_book( $post ) {
		$is_gutenberg_active = use_block_editor_for_post_type( get_post_type() );
		$context             = $is_gutenberg_active ? 'side' : 'normal';
		add_meta_box(
			'book-details',
			__( 'Book details', 'rocket-books' ),
			array( $this, 'book_metabox_display_cb' ),
			'book',
			$context,
			'high'
		);
	}

	public function book_metabox_display_cb( $post ) {
		wp_nonce_field( 'rbr_meta_box_nonce_action', 'rbr_meta_box_nonce' )
		?>
		<p>
			<label for="rbr_book_pages"><?php _e( 'Number of pages', 'rocket-books' ); ?></label>
			<input type="text" name="rbr_book_pages" class="widefat"
				   value="<?php echo get_post_meta( get_the_ID(), 'rbr_book_pages', true ); ?>">
		</p>
		<p>
			<label for="rbr-is-featured"><?php _e( 'Is featured', 'rocket-books' ); ?></label>
			<input type="checkbox" name="rbr-is-featured" value="yes"
				<?php checked( get_post_meta( get_the_ID(), 'rbr_is_featured', true ), 'yes' ); ?>
			/>
		</p>
		<p>
			<?php $book_format_from_db = get_post_meta( get_the_ID(), 'rbr_book_format', true ); ?>
			<label for="rbr-book-format">Book format</label>
			<select name="rbr-book-format" id="rbr-book-format" class="widefat">
				<option value="">Select option</option>
				<option value="hardcover"
					<?php selected( $book_format_from_db, 'hardcover' ); ?>
				>Hardcover
				</option>
				<option value="audio"
					<?php selected( $book_format_from_db, 'audio' ); ?>
				>Audio
				</option>
				<option value="pdf"
					<?php selected( $book_format_from_db, 'pdf' ); ?>
				>PDF
				</option>
			</select>
		</p>

		<?php
	}

	public function metabox_save_book( $post_id, $post, $update ) {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {

			return;
		}

		if ( ! current_user_can( 'edit_posts', $post_id ) ) {
			echo __( 'Sorry you can not edit' );
			exit;
		}

		if ( ! isset( $_POST['rbr_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['rbr_meta_box_nonce'], 'rbr_meta_box_nonce_action' ) ) {
			return null;
		}
		update_post_meta( get_the_ID(), 'rbr_book_pages', absint( $_POST['rbr_book_pages'] ) );
		update_post_meta(
			get_the_ID(),
			'rbr_is_featured',
			( 'yes' === $_POST['rbr-is-featured'] ? 'yes' : 'no' )
		);

		$book_format = in_array(
			$_POST['rbr-book-format'],
			array(
				'hardcover',
				'audio',
				'pdf',
			)
		) ? sanitize_key( $_POST['rbr-book-format'] ) : 'no-format';
		update_post_meta(
			get_the_ID(),
			'rbr_book_format',
			$book_format
		);
	}

	public function register_cmb2_metabox_book() {
		$metabox = new_cmb2_box(
			array(
				'id'           => 'book-details',
				'title'        => __( 'Book details from CMB2', 'rocket-books' ),
				'object_types' => array( 'book' ),
				'context'      => 'side',
			)
		);

		$metabox->add_field(
			array(
				'id'              => 'rbr_book_pages',
				'name'            => __( 'Number of pages', 'rocket-books' ),
				'type'            => 'text',
				'sanitization_cb' => 'absint',
			)
		);

		$metabox->add_field(
			array(
				'id'      => 'rbr_book_format',
				'name'    => __( 'Format', 'rocket-books' ),
				'type'    => 'select',
				'options' => array(
					'no-format' => __( 'Select format', 'rocket-books' ),
					'hardcover' => __( 'Hardcover', 'rocket-books' ),
					'audio'     => __( 'Audio', 'rocket-books' ),
					'pdf'       => __( 'PDF', 'rocket-books' ),
				),
				'default' => 'no-format',
			)
		);
	}
}
