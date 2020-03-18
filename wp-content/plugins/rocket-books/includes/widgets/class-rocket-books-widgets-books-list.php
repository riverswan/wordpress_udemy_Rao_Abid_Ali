<?php


if ( ! class_exists( 'Rocket_Books_Widgets_Books_List ' ) ) {

	class Rocket_Books_Widgets_Books_List extends WP_Widget {

		/**
		 * Sets up the widgets name etc
		 */
		public function __construct() {
			$widget_ops = array(
				'classname'   => 'rbr_books_list_class',
				'description' => __( 'Display Rocket Books list', 'rocket-books' ),
			);
			parent::__construct( 'rbr_books_list', __( 'Books List', 'rocket-books' ), $widget_ops );
		}

		/**
		 * Outputs the content of the widget
		 *
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			echo $args['before_widget'];
			echo $args['before_title'];
			echo isset( $instance['title'] ) ? esc_html( $instance['title'] ) : '';
			echo $args['after_title'];
			echo $args['after_widget'];

			$loop_args = array(
				'post_type'     => 'book',
				'post_per_page' => 5,
			);

			$loop = new WP_Query( $loop_args );

			echo '<div class="cpt-cards-widget">';
			while ( $loop->have_posts() ) :
				$loop->the_post();
				include ROCKET_BOOKS_BASE_DIR . 'templates/widgets/content-book.php';
			endwhile;
			echo '</div>';
		}

		/**
		 * Outputs the options form on admin
		 *
		 * @param array $instance The widget options
		 */
		public function form( $instance ) {

			$title = isset( $instance['title'] ) ? $instance['title'] : '';
			$limit = isset( $instance['limit'] ) ? $instance['limit'] : 3;
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>">
					<?php _e( 'Title', 'rocket-books' ); ?>
				</label>
				<input
						type="text"
						class="widefat"
						id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
						name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
						value="<?php echo esc_html( $title ); ?>"
				>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>">
					<?php _e( 'Limit', 'rocket-books' ); ?>
				</label>
				<input
						type="number"
						class="widefat"
						id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"
						name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>"
						value="<?php echo esc_html( $limit ); ?>"
				>
			</p>
			<?php
		}

		/**
		 * Processing widget options on save
		 *
		 * @param array $new_instance The new options
		 * @param array $old_instance The previous options
		 *
		 * @return array
		 */
		public function update( $new_instance, $old_instance ) {
			$sanitized_instance['title'] = sanitize_text_field( $new_instance['title'] );
			$sanitized_instance['limit'] = absint( $new_instance['limit'] );

			return $sanitized_instance;
		}
	}

}
