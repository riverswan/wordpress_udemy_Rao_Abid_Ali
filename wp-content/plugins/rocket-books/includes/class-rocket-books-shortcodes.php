<?php declare( strict_types=1 );


if ( ! class_exists( 'Rocket_Books_Shortcodes' ) ) {

	class Rocket_Books_Shortcodes {


		private $plugin_name;


		private $version;

		private $shortcode_css;


		public function __construct( $plugin_name, $version ) {

			$this->plugin_name = $plugin_name;
			$this->version     = $version;
			$this->setup_hooks();

		}

		public function book_list( $args, $content ) {

			$args = shortcode_atts(
				array(
					'limit'   => get_option( 'posts_per_page' ),
					'column'  => 3,
					'bgcolor' => '#f6f6f6',
					'genre'   => '',
					'book_id' => '',
				),
				$args,
				'book_list'
			);

			$loop_args = array(
				'post_type'      => 'book',
				'posts_per_page' => $args['limit'],
			);

			if ( ! empty( $args['book_id'] ) ) {
				$loop_args['p'] = absint( $args['book_id'] );
			}

			if ( ! empty( $args['genre'] ) ) {
				$loop_args['tax_query'] = array(
					array(
						'taxonomy' => 'genre',
						'field'    => 'slug',
						'terms'    => explode( ',', $args['genre'] ),
					),
				);
			}

			$loop = new WP_Query( $loop_args );

			$grid_column = rbr_get_column_class( $args['column'] );
			$this->add_css_books_list( $args );

			ob_start();
			?>
			<div class="cpt-cards cpt-shortcodes <?php echo sanitize_html_class( $grid_column ); ?>">
				<?php
				// Start the Loop.
				while ( $loop->have_posts() ) :
					$loop->the_post();
					include ROCKET_BOOKS_BASE_DIR . 'templates/archive/content-book.php';
				endwhile;
				wp_reset_postdata();
				?>
			</div>
			<?php
			return ob_get_clean();
		}

		public function setup_hooks() {
			add_action( 'wp_enqueue_scripts', array( $this, 'register_style' ) );
			add_action( 'get_footer', array( $this, 'maybe_enqueue_scripts' ) );
		}

		public function register_style() {
			wp_register_style(
				$this->plugin_name . '-shortcodes',
				ROCKET_BOOKS_URL_PATH . 'public/css/rocket-books-shortcodes.css',
			);
		}

		public function add_css_books_list( $args ) {
			$css                  = ".cpt-cards.cpt-shortcodes .cpt-card {background-color: {$args['bgcolor']};}";
			$this->shortcode_css .= $css;
		}

		public function maybe_enqueue_scripts() {
			if ( ! empty( $this->shortcode_css ) ) {
				wp_add_inline_style( $this->plugin_name . '-shortcodes', $this->shortcode_css );
				wp_enqueue_style( $this->plugin_name . '-shortcodes' );
			}
		}
	}
}

