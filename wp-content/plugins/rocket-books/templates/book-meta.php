<?php declare( strict_types=1 );

?>
<ul class="book-meta-fields">
	<?php
	$meta_fields       = array(
		'rbr_book_pages'  => __( 'Pages', 'rocket-books' ),
		'rbr_book_format' => __( 'Format', 'rocket-books' ),
		'rbr_is_featured' => __( 'Is featured', 'rocket-books' ),
	);
	$meta_fields_icons = array(
		'rbr_book_pages'  => '<i class="fas fa-file"></i>',
		'rbr_book_format' => '<i class="fas fa-book-open"></i>',
		'rbr_is_featured' => '<i class="far fa-grin-stars"></i>',
	);

	$html = '';
	foreach ( $meta_fields as $meta_key => $label ) {
		$value = esc_html( get_post_meta( get_the_ID(), $meta_key, true ) );
		if ( empty( $value ) ) {
			continue;
		}

		$html .= "<li>{$meta_fields_icons[$meta_key]} {$label}: {$value}</li>";

	}
	echo $html;
	?>
</ul>

