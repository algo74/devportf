<?php
/**
 *
 * @package devportf
 */



?>

<section id="ht-portfolio-section" class="ht-section">
	<div class="ht-container">
	<?php
	$devportf_portfolio_title = get_theme_mod('devportf_portfolio_title');
	$devportf_portfolio_sub_title = get_theme_mod('devportf_portfolio_sub_title');
	?>

	<?php 
	if( $devportf_portfolio_title || $devportf_portfolio_sub_title ){ ?>
	<div class="ht-section-title-tagline">
		<?php 
		if($devportf_portfolio_title){ ?>
		<h2 class="ht-section-title"><?php echo esc_html($devportf_portfolio_title); ?></h2>
		<?php } ?>

		<?php if($devportf_portfolio_sub_title){ ?>
		<div class="ht-section-tagline"><?php echo esc_html($devportf_portfolio_sub_title); ?></div>
		<?php } ?>
	</div>
	<?php } ?>

	<?php 
    
    if(devportf_portfolio_is_set()) {  
        
        $devportf_portfolio_cat = get_theme_mod('devportf_portfolio_cat');

        if($devportf_portfolio_cat){
            $devportf_portfolio_cat_array = explode(',', $devportf_portfolio_cat) ;
            
            // variables used for finding and marking active category
            $devportf_active_category = $_GET['dpcat'];
            $devportf_active_category_found = false;
            $devportf_active_category_buffer = '';
            
            ?>	
            <div class="ht-portfolio-cat-name-list">
                <i class="fa fa-th-large" aria-hidden="true"></i>
                <?php 
                foreach ($devportf_portfolio_cat_array as $devportf_portfolio_cat_single) {
                    $devportf_active_category_buffer .= '<div class="ht-portfolio-cat-name';
                    $category_slug = strval(get_category($devportf_portfolio_cat_single)->term_id);
                    if($category_slug == $devportf_active_category) {
                        $devportf_active_category_buffer .= ' active';
                        $devportf_active_category_found = true;
                    }
                    $category_slug = 'devportf-portfolio-' . $category_slug;
                    $devportf_active_category_buffer .= '" data-filter=".' . esc_attr($category_slug) . '">' . get_cat_name($devportf_portfolio_cat_single) . '</div> ';
                }
                ?>
                <div class="ht-portfolio-cat-name<?php if(!$devportf_active_category_found) { echo(' acitve'); } ?>" data-filter=".devportf-portfolio-all">All</div>
                <?php 
                echo($devportf_active_category_buffer);
                ?>
            </div>
        <?php 
        } 
        ?>

        <div class="ht-portfolio-post-wrap">
            <div class="ht-portfolio-posts ht-clearfix">
                <?php 
                if($devportf_portfolio_cat){
                $count = 1;
                $args = array( 'cat' => $devportf_portfolio_cat, 'posts_per_page' => -1 , 'post_type' => get_theme_mod('devportf_portfolio_type'));
                $query = new WP_Query($args);
                if($query->have_posts()):
                    while($query->have_posts()) : $query->the_post();	
                    $categories = get_the_category();
                    $category_slug = "";
                    $cat_slug = array();
                    // mod by Alex G 
                    $cat_slug[] = 'devportf-portfolio-all';

                    foreach ($categories as $category) {
                        $cat_slug[] = 'devportf-portfolio-'.$category->term_id;
                    }

                    $category_slug = implode(" ", $cat_slug);

                    if(has_post_thumbnail()){
                        $image_url = get_template_directory_uri().'/images/portfolio-small-blank.png';
                        $devportf_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'devportf-portfolio-thumb');	
                        $devportf_image_large = wp_get_attachment_image_src(get_post_thumbnail_id(),'large');
                    }else{
                        $image_url = get_template_directory_uri().'/images/portfolio-small.png';
                        $devportf_image = "";
                    }
                ?>
                    <div class="ht-portfolio <?php echo esc_attr($category_slug); ?>">
                        <div class="ht-portfolio-outer-wrap">
                        <div class="ht-portfolio-wrap" style="background-image: url(<?php echo esc_url($devportf_image[0]) ?>);">

                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php esc_attr(get_the_title()); ?>">

                        <div class="ht-portfolio-caption">
                            <h5><?php the_title(); ?></h5>

                            <div>
                            <?php 
                            if(has_excerpt()){
                                echo get_the_excerpt();
                            }else{
                                echo devportf_excerpt( get_the_content() , 100 );
                            }
                            ?>
                            </div>

                            <a class="ht-portfolio-wrap-link" href="<?php echo esc_url(get_permalink()); ?>"></a>

                            <a class="ht-portfolio-link" href="<?php echo esc_url(get_permalink()); ?>"><i class="fa fa-link"></i></a>

                            <?php if(has_post_thumbnail()){ ?>
                                <a class="ht-portfolio-image" data-lightbox-gallery="gallery1" href="<?php echo esc_url($devportf_image_large[0]) ?>"><i class="fa fa-search"></i></a>
                            <?php } ?>
                        </div>
                        </div>
                        </div>
                    </div>
                <?php
                endwhile;
                endif;	
                wp_reset_postdata();
                }
                ?>
            </div>
            <?php
            ?>
        </div>
    <?php 
    } else {
    ?>
        not set
    <?php 
    }
    ?>
	</div>
</section>
