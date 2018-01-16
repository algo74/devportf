<?php
/**
 *
 * @package devportf
 */

?>
<section id="ht-logo-section" class="ht-section">
	<div class="ht-container">
		<?php
		$devportf_logo_title = get_theme_mod('devportf_logo_title');
		$devportf_logo_sub_title = get_theme_mod('devportf_logo_sub_title');
		?>
		<?php if($devportf_logo_title || $devportf_logo_sub_title){ ?>
		<div class="ht-section-title-tagline">
		<?php if($devportf_logo_title){ ?>
		<h2 class="ht-section-title"><?php echo esc_html($devportf_logo_title); ?></h2>
		<?php } ?>

		<?php if($devportf_logo_sub_title){ ?>
		<div class="ht-section-tagline"><?php echo esc_html($devportf_logo_sub_title); ?></div>
		<?php } ?>
		</div>
		<?php } ?>

		<?php 
		$devportf_client_logo_image = get_theme_mod('devportf_client_logo_image');
		$devportf_client_logo_image = explode(',', $devportf_client_logo_image);
		?>

		<div class="ht_client_logo_slider owl-carousel">
		<?php
		foreach ($devportf_client_logo_image as $devportf_client_logo_image_single) {
			$image = wp_get_attachment_image_src( $devportf_client_logo_image_single, 'full');
			?>
			<img src="<?php echo esc_url( $image[0] ); ?>">
			<?php
		}
		?>
		</div>
	</div>
</section>
