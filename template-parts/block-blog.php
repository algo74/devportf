<?php
/**
 *
 * @package devportf
 */

?>
<section id="ht-blog-section" class="ht-section">
	<div class="ht-container">
		<?php
		$devportf_blog_title = get_theme_mod('devportf_blog_title');
		$devportf_blog_sub_title = get_theme_mod('devportf_blog_sub_title');
		?>
		<?php if($devportf_blog_title || $devportf_blog_sub_title){ ?>
		<div class="ht-section-title-tagline">
		<?php if($devportf_blog_title){ ?>
		<h2 class="ht-section-title"><?php echo esc_html($devportf_blog_title); ?></h2>
		<?php } ?>

		<?php if($devportf_blog_sub_title){ ?>
		<div class="ht-section-tagline"><?php echo esc_html($devportf_blog_sub_title); ?></div>
		<?php } ?>
		</div>
		<?php } ?>

		<div class="ht-blog-wrap ht-clearfix">
		<?php 
			$devportf_blog_post_count = get_theme_mod('devportf_blog_post_count', 3 );
			$devportf_blog_cat_exclude = get_theme_mod('devportf_blog_cat_exclude');
            $devportf_blog_cat_exclude = explode(',', $devportf_blog_cat_exclude);

			$args = array(
				'posts_per_page' => absint($devportf_blog_post_count),
				'category__not_in' => $devportf_blog_cat_exclude
				);
			$query = new WP_Query($args);
			if($query -> have_posts()):
				while($query -> have_posts()) : $query -> the_post();
				$devportf_image = wp_get_attachment_image_src(get_post_thumbnail_id() , 'devportf-blog-thumb');
				?>
				<div class="ht-blog-post ht-clearfix">
					<?php 
					if(has_post_thumbnail()){
					?> 
						<div class="ht-blog-thumbnail">
							<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($devportf_image[0]) ?>" alt="<?php the_title(); ?>"></a>
						</div>
					<?php
					}
					?>
					<div class="ht-blog-excerpt">
					<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
					<div class="ht-blog-date"><i class="fa fa-calendar-o" aria-hidden="true"></i><?php echo get_the_date(); ?></div>
						<?php 
						if(has_excerpt()){
							echo get_the_excerpt();
						}else{
							echo devportf_excerpt( get_the_content() , 190 );
						}
						?>
					</div>

					<div class="ht-blog-read-more">
						<a href="<?php the_permalink(); ?>"><?php _e('Read More', 'devportf'); ?></a>
					</div>
				</div>
				<?php
				endwhile;
			endif;
			wp_reset_postdata();
		?>
		</div>	
	</div>
</section>
