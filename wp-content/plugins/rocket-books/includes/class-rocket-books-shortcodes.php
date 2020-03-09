<?php declare( strict_types=1 );


if ( ! class_exists( 'Rocket_Books_Shortcodes' ) ) {

	class Rocket_Books_Shortcodes {


		private $plugin_name;


		private $version;


		public function __construct( $plugin_name, $version ) {

			$this->plugin_name = $plugin_name;
			$this->version     = $version;
			$this->setup_hooks();

		}

		public function book_list( $args, $content ) {

			$args = shortcode_atts(
				array(
					'limit'  => get_option( 'posts_per_page' ),
					'column' => 3,
				),
				$args,
				'book_list'
			);

			$loop_args = array(
				'post_type'      => 'book',
				'posts_per_page' => $args['limit'],
				'bgcolor'        => '#f6f6f6',
			);
			$loop      = new WP_Query( $loop_args );

			$grid_column = rbr_get_column_class( $args['column'] );

			ob_start();
			?>
			<div class="cpt-cards <?php echo sanitize_html_class( $grid_column ); ?>">
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
		}

		public function register_style() {
		    wp_register_style($this->plugin_name . '-shortcodes','','','','');
		}
	}
}

