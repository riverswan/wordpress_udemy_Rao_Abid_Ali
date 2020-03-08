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
