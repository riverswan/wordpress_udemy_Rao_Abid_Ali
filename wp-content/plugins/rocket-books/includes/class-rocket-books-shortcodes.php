<?php declare( strict_types=1 );


if ( ! class_exists( 'Rocket_Books_Shortcodes' ) ) {

	class Rocket_Books_Shortcodes {


		private $plugin_name;


		private $version;


		public function __construct( $plugin_name, $version ) {

			$this->plugin_name = $plugin_name;
			$this->version     = $version;

		}

		public function book_list( $args, $content ) {

			$args = shortcode_atts(
				array(
					'limit' => 3,
				),
				$args,
				'book_list'
			);

			$loop_args = array(
				'post_type'      => 'book',
				'posts_per_page' => $args['limit'],
			);
			$loop      = new WP_Query( $loop_args );

			ob_start();
			?>
			<div class="cpt-cards column-three">
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
	}
}

