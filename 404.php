<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package devportf
 */

get_header(); ?>

<header class="ht-main-header">
	<div class="ht-container">
		<h1 class="ht-main-title"><?php esc_html_e( '404 Error', 'devportf' ); ?></h1>
		<?php do_action( 'devportf_breadcrumbs' ); ?>
	</div>
</header><!-- .entry-header -->


<div class="ht-container">
	<div class="oops-text"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'devportf' ); ?></div>
	<span class="error-404"><?php esc_html_e( '404', 'devportf' ); ?></span>
</div>

<?php get_footer(); ?>
