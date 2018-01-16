<?php
/**
 *
 * @package devportf
 */

if(get_theme_mod('devportf_portfolio_section_disable') != 'on' ){ 
    get_template_part( 'template-parts/block', 'portfolio' );
}