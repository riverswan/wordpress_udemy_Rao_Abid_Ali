<?php declare( strict_types=1 );
/**
 * Plugin name: My fluffy cat
 */


add_action( 'admin_menu', 'mfc_plugin_menu' );

function mfc_plugin_menu() {
	add_menu_page(
		'My fluffy cat',
		'Fluffy cat',
		'manage_options',
		'my-fluffy-cat',
		'mfc_page_display',
		'dashicons-heart'
	);
}


function mfc_page_display() {
	echo "My cats will be playing here \n";
}


add_filter( 'the_content', 'mfc_content_filter' );

function mfc_content_filter( $content ) {
	$content = 'My fluffy cat says ' . $content;

	return $content;
}

add_filter( 'body_class', 'mfc_add_body_class' );

function mfc_add_body_class( $body_classes ) {
	if ( is_single() ) {
		$body_classes[] = 'my-fluffy-cat-class';
	}

	return $body_classes;
}