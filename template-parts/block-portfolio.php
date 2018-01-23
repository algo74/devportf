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
	<?php } 

	get_template_part( 'template-parts/innerblock', 'portfolio' );
        
    ?>
	</div>
</section>
