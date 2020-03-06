<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-book-container' ); ?>>

    <div class="book-meta-container">
        <div class="book-entry-img">
			<?php the_post_thumbnail(); ?>
        </div>
    </div>

    <div class="book-entry-content">
		<?php
		the_content();

		?>
    </div><!-- .entry-content -->

    <footer class="book-entry-footer">

		<?php
		edit_post_link(
			sprintf(
			/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'rocket-books' ),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
		?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
