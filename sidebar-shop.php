<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package devportf
 */

if ( ! is_active_sidebar( 'devportf-shop-sidebar' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'devportf-shop-sidebar' ); ?>
</div><!-- #secondary -->
