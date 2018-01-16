<?php
/**
 * Template Name: Home Page
 *
 * @package devportf
 */

get_header();

	$devportf_home_sections = devportf_home_section();

	foreach ($devportf_home_sections as $devportf_home_section) {
		get_template_part( 'template-parts/section', $devportf_home_section );
	}

get_footer(); 