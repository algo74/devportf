<?php
/**
 * Template part for displaying posts.
 *
 * @package devportf
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('devportf-hentry'); ?>>
	<?php if ( 'post' == get_post_type() ) : ?>
	<div class="entry-meta ht-post-info">
		<?php devportf_posted_on(); ?>
	</div><!-- .entry-meta -->
	<?php endif; ?>


	<div class="ht-post-wrapper">
		<?php if(has_post_thumbnail()): ?>
		<figure class="entry-figure">
			<?php 
			$devportf_image = wp_get_attachment_image_src( get_post_thumbnail_id() , 'devportf-blog-header' );
			?>
			<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($devportf_image[0]); ?>" alt="<?php echo esc_attr( get_the_title() ) ?>"></a>
		</figure>
		<?php endif; ?>
        
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-categories">
            <?php echo devportf_entry_category(); ?>
		</div>
        
		<div class="entry-content">
			<?php
				echo wp_trim_words( get_the_content(), 130 );
			?>
		</div><!-- .entry-content -->

		<div class="entry-readmore">
			<a href="<?php the_permalink(); ?>"><?php _e( 'Read More', 'devportf' ); ?></a>
		</div>
	</div>
</article><!-- #post-## -->
