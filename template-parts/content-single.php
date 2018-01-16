<?php
/**
 * Template part for displaying single posts.
 *
 * @package devportf
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<div class="entry-meta ht-post-info">
			<?php devportf_posted_on(); ?>
		</div><!-- .entry-meta -->
		
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'devportf' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->

