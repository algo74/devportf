<?php
/**
 *
 * @package devportf
 */

?>
<section id="ht-team-section" class="ht-section">
	<div class="ht-container">
		<?php
		$devportf_team_title = get_theme_mod('devportf_team_title');
		$devportf_team_sub_title = get_theme_mod('devportf_team_sub_title');
		?>
		<?php if( $devportf_team_title || $devportf_team_sub_title ){ ?>
			<div class="ht-section-title-tagline">
				<?php if($devportf_team_title){ ?>
				<h2 class="ht-section-title"><?php echo esc_html($devportf_team_title); ?></h2>
				<?php } ?>

				<?php if($devportf_team_sub_title){ ?>
				<div class="ht-section-tagline"><?php echo esc_html($devportf_team_sub_title); ?></div>
				<?php } ?>
			</div>
		<?php } ?>

		<div class="ht-team-member-wrap ht-clearfix">
			<?php 
			for( $i = 1; $i < 5; $i++ ){
				$devportf_team_page_id = get_theme_mod('devportf_team_page'.$i); 
				$devportf_team_page_icon = get_theme_mod('devportf_team_page_icon'.$i);
			
				if($devportf_team_page_id){
					$args = array( 'page_id' => absint($devportf_team_page_id) );
					$query = new WP_Query($args);
					if($query->have_posts()):
						while($query->have_posts()) : $query->the_post();
						$devportf_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'devportf-team-thumb');	
						$devportf_team_designation = get_theme_mod('devportf_team_designation'.$i);
						$devportf_team_facebook = get_theme_mod('devportf_team_facebook'.$i);
						$devportf_team_twitter = get_theme_mod('devportf_team_twitter'.$i);
						$devportf_team_google_plus = get_theme_mod('devportf_team_google_plus'.$i);
					?>
						<div class="ht-team-member">
							
							<div class="ht-team-member-image">
								<?php if( has_post_thumbnail() ){
									$image_url = $devportf_image[0];
								}else{
									$image_url = get_template_directory_uri().'/images/team-thumb.png';
								} ?>
								
								<img src="<?php echo esc_url($image_url);?>" alt="<?php the_title(); ?>" />
								<div class="ht-title-wrap">
								<h6><?php the_title(); ?></h6>
								</div>

								<a href="<?php the_permalink(); ?>" class="ht-team-member-excerpt">
									<div class="ht-team-member-excerpt-wrap">
									<div class="ht-team-member-span">
                                        <h6><?php the_title(); ?></h6>
								
        								<?php if($devportf_team_designation){ ?>
        									<div class="ht-team-designation"><?php echo esc_html($devportf_team_designation); ?></div>
                                         <?php } ?>
                                         <span class="ht-team-excerpt">  
                                            <?php 
                                                if(has_excerpt()){
                                                    echo get_the_excerpt();
                                                }else{
                                                    echo devportf_excerpt( get_the_content() , 100 );
                                                }
                                            ?>
                                        </span>
									   <div class="ht-team-detail"><?php _e('Detail', 'devportf') ?></div>
									</div>
									</div>
								</a>
							</div>	

							<?php if( $devportf_team_facebook || $devportf_team_twitter || $devportf_team_google_plus ){ ?>
								<div class="ht-team-social-id">
									<?php if($devportf_team_facebook){ ?>
									<a target="_blank" href="<?php echo esc_url($devportf_team_facebook) ?>"><i class="fa fa-facebook"></i></a>
									<?php } ?>

									<?php if($devportf_team_twitter){ ?>
									<a target="_blank" href="<?php echo esc_url($devportf_team_twitter) ?>"><i class="fa fa-twitter"></i></a>
									<?php } ?>

									<?php if($devportf_team_google_plus){ ?>
									<a target="_blank" href="<?php echo esc_url($devportf_team_google_plus) ?>"><i class="fa fa-google-plus"></i></a>
									<?php } ?>
								</div>
							<?php } ?>
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
