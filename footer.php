<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package devportf
 */

?>

	</div><!-- #content -->

	<footer id="ht-colophon" class="ht-site-footer">
		<?php if(is_active_sidebar('devportf-footer1') || is_active_sidebar('devportf-footer2') || is_active_sidebar('devportf-footer3') || is_active_sidebar('devportf-footer4')){ ?>
		<div id="ht-top-footer">
			<div class="ht-container">
				<div class="ht-top-footer ht-clearfix">
					<div class="ht-footer ht-footer1">
						<?php if(is_active_sidebar('devportf-footer1')): 
							dynamic_sidebar('devportf-footer1');
						endif;
						?>	
					</div>

					<div class="ht-footer ht-footer2">
						<?php if(is_active_sidebar('devportf-footer2')): 
							dynamic_sidebar('devportf-footer2');
						endif;
						?>	
					</div>

					<div class="ht-footer ht-footer3">
						<?php if(is_active_sidebar('devportf-footer3')): 
							dynamic_sidebar('devportf-footer3');
						endif;
						?>	
					</div>

					<div class="ht-footer ht-footer4">
						<?php if(is_active_sidebar('devportf-footer4')): 
							dynamic_sidebar('devportf-footer4');
						endif;
						?>	
					</div>
				</div>
			</div>
		</div>
		<?php } ?>

		<div id="ht-bottom-footer">
			<div class="ht-container">
				<div class="ht-site-info">
					<?php printf( esc_html__( 'WordPress Theme', 'devportf' ) ); ?>
					<span class="sep"> </span>
					<?php printf( esc_html__( '%1$s by %2$s - based on %3$s by %4$s', 'devportf' ), '"Developer Portfolio"','Alex Goponenko','<a href="https://hashthemes.com/wordpress-theme/total/" target="_blank">Total</a>', 'Hash Themes' ); ?>
				</div><!-- #site-info -->
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<div id="ht-back-top" class="ht-hide"><i class="fa fa-angle-up" aria-hidden="true"></i></div>
<?php wp_footer(); ?>

</body>
</html>
