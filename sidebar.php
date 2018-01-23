<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package devportf
 */

$devportf_sidebar_layout = "right_sidebar";

if( is_singular( /*array( 'post', 'page' )*/) ){
	$devportf_sidebar_layout = get_post_meta( $post->ID, 'devportf_sidebar_layout', true );
	if(!$devportf_sidebar_layout){
		$devportf_sidebar_layout = "right_sidebar";
	}
}

if ( $devportf_sidebar_layout == "no_sidebar" || $devportf_sidebar_layout == "no_sidebar_condensed" ) {
	return;
}

if( is_active_sidebar( 'devportf-right-sidebar' ) &&  $devportf_sidebar_layout == "right_sidebar" ){
	?>
	<div id="secondary" class="widget-area">
		<?php dynamic_sidebar( 'devportf-right-sidebar' ); ?>
	</div><!-- #secondary -->
	<?php
}

if( is_active_sidebar( 'devportf-left-sidebar' ) &&  $devportf_sidebar_layout == "left_sidebar" ){
	?>
	<div id="secondary" class="widget-area">
		<?php dynamic_sidebar( 'devportf-left-sidebar' ); ?>
	</div><!-- #secondary -->
	<?php
}