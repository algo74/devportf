<?php
/**
 * The template part for displaying results in search pages.
 *
 * @package devportf
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('devportf-hentry'); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			echo wp_trim_words( get_the_content(), 130 );
		?>
	</div><!-- .entry-content -->

	<div class="entry-readmore">
		<a href="<?php the_permalink(); ?>"><?php _e( 'Read More', 'devportf' ); ?></a>
	</div>

</article><!-- #post-## -->

