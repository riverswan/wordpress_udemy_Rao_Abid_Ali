<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>


<?php
// Start the loop.
while ( have_posts() ) :
	the_post();
	include ROCKET_BOOKS_BASE_DIR . 'templates/single/content-book.php';


	// Previous/next post navigation.
	the_post_navigation(
		array(
			'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'rocket-books' ) . '</span> ' .
						   '<span class="screen-reader-text">' . __( 'Next post:', 'rocket-books' ) . '</span> ' .
						   '<span class="post-title">%title</span>',
			'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'rocket-books' ) . '</span> ' .
						   '<span class="screen-reader-text">' . __( 'Previous post:', 'rocket-books' ) . '</span> ' .
						   '<span class="post-title">%title</span>',
		)
	);


	// End of the loop.
endwhile;
?>


<?php
get_footer();
