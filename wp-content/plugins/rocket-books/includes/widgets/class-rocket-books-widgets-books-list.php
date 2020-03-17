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
			echo isset( $instance['title'] ) ? $instance['title'] : '';
			echo $args['after_title'];
			echo $args['after_widget'];
		}

		/**
		 * Outputs the options form on admin
		 *
		 * @param array $instance The widget options
		 */
		public function form( $instance ) {

			$title = isset( $instance['title'] ) ? $instance['title'] : '';
			?>
			<p>
                <label for="<?php echo esc_attr( $this->get_field_name( 'title' ) ) ?>">
                    <?php _e('Title','rocket-books') ?>
                </label>
				<input
						type="text"
						class="widefat"
						id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
						name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
						value="<?php echo esc_html( $title ); ?>"
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
			$sanitized_instance = $new_instance;
			return $sanitized_instance;
		}
	}

}
