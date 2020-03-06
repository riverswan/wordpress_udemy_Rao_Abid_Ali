<?php declare( strict_types=1 );

?>
<ul class="book-meta-fields">
	<?php
	$meta_fields = array(
		'rbr_book_pages'  => __( 'Pages', 'rocket-books' ),
		'rbr_book_format' => __( 'Format', 'rocket-books' ),
		'rbr_is_featured' => __( 'Is featured', 'rocket-books' ),
	);

	$html = '';
	foreach ( $meta_fields as $meta_key => $label ) {
		$value = esc_html( get_post_meta( get_the_ID(), $meta_key, true ) );
		if ( empty( $value ) ) {
			continue;
		}

		$html .= "<li>{$label}: {$value}</li>";

	}
	echo $html;
	?>
</ul>

