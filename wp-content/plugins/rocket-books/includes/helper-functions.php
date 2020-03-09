<?php declare( strict_types=1 );

function rbr_is_single_or_archive_book() {
	return ( is_singular( 'book' ) || is_archive_book() ) ? true : false;
}

function rbr_get_template_loader() {
	return Rocket_Books_Global::template_loader();
}

function is_archive_book() {
	return (
		is_post_type_archive( 'book' ) || is_tax( 'genre' )
	) ? true : false;
}

function rbr_get_column_class( $value ) {
	switch ( $value ) {
		case 2:
			return 'column-two';
			break;
		case 3:
			return 'column-three';
			break;
		case 4:
			return 'column_four';
			break;
		case 5:
			return 'column-five';
			break;
		default:
			return 'column-three';
	}
}
