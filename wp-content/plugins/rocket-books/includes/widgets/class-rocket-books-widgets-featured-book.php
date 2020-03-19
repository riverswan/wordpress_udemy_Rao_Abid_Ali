<?php


if ( ! class_exists( 'Rocket_Books_Widgets_Featured_Book ' ) ) {

	class Rocket_Books_Widgets_Featured_Book extends Boo_Widget_Helper {

		/**
		 * Sets up the widgets name etc
		 */
		public function __construct() {
			$config_array = array(
				'id'   => 'rbr_featured_book',
				'name' => __( 'Featured Books', 'rocket-books' ),
				'desc' => __( 'Display your featured books', 'rocket-books' ),
			);

			$this->set_fields( $this->get_fields_args() );
			parent::__construct( $config_array );
		}

		public function get_fields_args() {
			$fields_args = array(
				array(
					'id'    => 'title',
					'label' => __( 'Title', 'rocket-books' ),
				),
				array(
					'id'    => 'text_color',
					'type'  => 'color',
					'label' => __( 'Text Color', 'rocket-books' ),
				),
				array(
					'id'    => 'bgcolor',
					'type'  => 'color',
					'label' => __( 'Background Color', 'rocket-books' ),
				),
				array(
					'id'      => 'book_id',
					'type'    => 'posts',
					'label'   => __( 'Select favourite book', 'rocket-books' ),
					'options' => array(
						'post_type' => 'book',
					),
				),
			);

			return $fields_args;
		}

		public function widget_display( $args, $instance ) {
			$text_color = isset( $instance['text_color'] ) ? $instance['text_color'] : '';
			$bgcolor    = isset( $instance['bgcolor'] ) ? $instance['bgcolor'] : '';
			$book_id    = isset( $instance['book_id'] ) ? $instance['book_id'] : '';
			echo do_shortcode( "[book_list column=1 limit=1 color={$text_color} bgcolor={$bgcolor} book_id={$book_id}]" );
		}

	}

}
