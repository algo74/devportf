<?php
/**
 * Template Name: Customizable Section Page
 *
 * @package devportf
 */

// setup shortcodes
function devportf_generic_scfunc( $block_name, $atts ){
	ob_start();
    get_template_part( 'template-parts/block', $block_name );
    $myStr = ob_get_contents();
    ob_end_clean();
    return $myStr;
}

function devportf_header_scfunc( $atts ){
	return devportf_generic_scfunc( 'header', $atts );
}
add_shortcode( 'header', 'devportf_header_scfunc' );

function devportf_about_scfunc( $atts ){
	return devportf_generic_scfunc( 'about', $atts );
}
add_shortcode( 'about', 'devportf_about_scfunc' );

function devportf_blog_scfunc( $atts ){
	return devportf_generic_scfunc( 'blog', $atts );
}
add_shortcode( 'blog', 'devportf_blog_scfunc' );

function devportf_counter_scfunc( $atts ){
	return devportf_generic_scfunc( 'counter', $atts );
}
add_shortcode( 'counter', 'devportf_counter_scfunc' );

function devportf_cta_scfunc( $atts ){
	return devportf_generic_scfunc( 'cta', $atts );
}
add_shortcode( 'cta', 'devportf_cta_scfunc' );

function devportf_featured_scfunc( $atts ){
	return devportf_generic_scfunc( 'featured', $atts );
}
add_shortcode( 'featured', 'devportf_featured_scfunc' );

function devportf_logo_scfunc( $atts ){
	return devportf_generic_scfunc( 'logo', $atts );
}
add_shortcode( 'logo', 'devportf_logo_scfunc' );

function devportf_portfolio_scfunc( $atts ){
	return devportf_generic_scfunc( 'portfolio', $atts );
}
add_shortcode( 'portfolio', 'devportf_portfolio_scfunc' );

function devportf_service_scfunc( $atts ){
	return devportf_generic_scfunc( 'service', $atts );
}
add_shortcode( 'service', 'devportf_service_scfunc' );

function devportf_slider_scfunc( $atts ){
	return devportf_generic_scfunc( 'slider', $atts );
}
add_shortcode( 'slider', 'devportf_slider_scfunc' );

function devportf_team_scfunc( $atts ){
	return devportf_generic_scfunc( 'team', $atts );
}
add_shortcode( 'team', 'devportf_team_scfunc' );

function devportf_testimonial_scfunc( $atts ){
	return devportf_generic_scfunc( 'testimonial', $atts );
}
add_shortcode( 'testimonial', 'devportf_testimonial_scfunc' );



// output page

get_header();

while ( have_posts() ) : 
    the_post(); 
    the_content();
endwhile;


get_footer(); 