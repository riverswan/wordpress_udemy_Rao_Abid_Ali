<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'cpt-card' ); ?>>
	<div class="book-meta-container">
		<div class="book-entry-img">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php include ROCKET_BOOKS_BASE_DIR . 'templates/book-meta.php'; ?>

		<div class="book-entry-content">
			<a href="<?php echo get_page_link( get_post() ); ?>">
				<?php
				the_title( '<h1 class="entry-title">', '</h1>' );
				?>
			</a>
			<!--				--><?php //the_content(); ?>

		</div><!-- .entry-content -->

	</div>

	<footer class="book-entry-footer">
		<?php
		edit_post_link(
			sprintf(
			/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
