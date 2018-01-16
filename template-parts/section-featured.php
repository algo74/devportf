<?php
/**
 *
 * @package devportf
 */

if(get_theme_mod('devportf_featured_section_disable') != 'on' ){ ?>
<section id="ht-featured-post-section" class="ht-section">
	<div class="ht-container">
		<?php
		$devportf_featured_title = get_theme_mod('devportf_featured_title');
		$devportf_featured_sub_title = get_theme_mod('devportf_featured_sub_title');
		?>
		<?php 
		if($devportf_featured_title || $devportf_featured_sub_title){
			?>
			<div class="ht-section-title-tagline">
			<?php
			if($devportf_featured_title){ ?>
			<h2 class="ht-section-title"><?php echo esc_html($devportf_featured_title); ?></h2>
			<?php } ?>

			<?php if($devportf_featured_sub_title){ ?>
			<div class="ht-section-tagline"><?php echo esc_html($devportf_featured_sub_title); ?></div>
			<?php } ?>
			</div>
		<?php } ?>

		<div class="ht-featured-post-wrap ht-clearfix">
			<?php 
			for( $i = 1; $i < 4; $i++ ){
				$devportf_featured_page_id = get_theme_mod('devportf_featured_page'.$i); 
				$devportf_featured_page_icon = get_theme_mod('devportf_featured_page_icon'.$i);
			
			if($devportf_featured_page_id){
				$args = array( 
                    'page_id' => absint($devportf_featured_page_id) 
                    );
				$query = new WP_Query($args);
				if( $query->have_posts() ):
					while($query->have_posts()) : $query->the_post();
				?>
					<div class="ht-featured-post">
						<div class="ht-featured-icon"><i class="<?php echo esc_attr($devportf_featured_page_icon); ?>"></i></div>
						<h5><?php the_title(); ?></h5>
						<div class="ht-featured-excerpt">
						<?php 
						if(has_excerpt()){
							echo get_the_excerpt();
						}else{
							echo devportf_excerpt( get_the_content(), 130); 
						}?>
						</div>
						<div class="ht-featured-link">
							<a href="<?php echo esc_url(get_permalink()); ?>"><?php _e( 'Read More', 'devportf' ); ?></a>
						</div>
					</div>
				<?php
				endwhile;
				endif;	
				wp_reset_postdata();
				}
			}
			?>
		</div>
	</div>
</section>
<?php }