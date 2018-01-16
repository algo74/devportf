<?php
/**
 * devportf Theme Customizer
 *
 * @package devportf
 */

/**
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function devportf_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	global $wp_registered_sidebars;

	$devportf_widget_list[] = __( "-- Don't Replace --", "devportf" ) ;
	foreach ($wp_registered_sidebars as $wp_registered_sidebar) {
		$devportf_widget_list[$wp_registered_sidebar['id']] = $wp_registered_sidebar['name'];
	}

	$devportf_categories = get_categories(array('hide_empty' => 0));
	foreach ($devportf_categories as $devportf_category) {
		$devportf_cat[$devportf_category->term_id] = $devportf_category->cat_name;
	}
    
	$devportf_pages = get_pages(array('hide_empty' => 0));
	foreach ($devportf_pages as $devportf_pages_single) {
		$devportf_page_choice[$devportf_pages_single->ID] = $devportf_pages_single->post_title; 
	}

	for ( $i = 1; $i <= 100 ; $i++) { 
		$devportf_percentage[$i] = $i; 
	}

	$devportf_post_count_choice = array( 3 => 3, 6 => 6, 9 => 9 ); 

	/*============GENERAL SETTINGS PANEL============*/
	$wp_customize->add_panel(
		'devportf_general_settings_panel',
		array(
			'title' => __( 'General Settings', 'devportf' ),
			'priority' => 10
		)
	);

	//STATIC FRONT PAGE
	$wp_customize->add_section( 'static_front_page', array(
	    'title' => __( 'Static Front Page', 'devportf' ),
	    'panel' => 'devportf_general_settings_panel',
	    'description' => __( 'Your theme supports a static front page.', 'devportf'),
	) );

	//TITLE AND TAGLINE SETTINGS
	$wp_customize->add_section( 'title_tagline', array(
	     'title' => __( 'Site Logo/Title/Tagline', 'devportf' ),
	     'panel' => 'devportf_general_settings_panel',
	) );

	//BACKGROUND IMAGE
// 2018-01-15 -removed
//	$wp_customize->add_section( 'background_image', array(
//	     'title' => __( 'Background Image', 'devportf' ),
//	     'panel' => 'devportf_general_settings_panel',
//	) );

	//COLOR SETTINGS
//  2018-01-15 - removed
//	$wp_customize->add_section( 'colors', array(
//	     'title' => __( 'Colors' , 'devportf'),
//	     'panel' => 'devportf_general_settings_panel',
//	) );
//
//	$wp_customize->add_setting(
//		'devportf_template_color',
//		array(
//			'default'			=> '#FFC107',
//			'sanitize_callback' => 'sanitize_hex_color',
//			'priority' => 1
//		)
//	);
//
//	$wp_customize->add_control(
//		new WP_Customize_Color_Control(
//			$wp_customize,
//			'devportf_template_color',
//			array(
//				'settings'		=> 'devportf_template_color',
//				'section'		=> 'colors',
//				'label'			=> __( 'Theme Primary Color ', 'devportf' ),
//			)
//		)
//	);

	//HEADER SETTINGS
	$wp_customize->add_section(
		'devportf_header_settings',
		array(
			'title' => __( 'Header Settings', 'devportf' ),
			'panel' => 'devportf_general_settings_panel',
		)
	);

	//ENABLE/DISABLE STICKY HEADER
	$wp_customize->add_setting(
		'devportf_sticky_header_enable',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default' => 'off'
		)
	);

	$wp_customize->add_control(
		new devportf_Switch_Control(
			$wp_customize,
			'devportf_sticky_header_enable',
			array(
				'settings'		=> 'devportf_sticky_header_enable',
				'section'		=> 'devportf_header_settings',
				'label'			=> __( 'Sticky Header', 'devportf' ),
				'on_off_label' 	=> array(
					'on' => __( 'Enable', 'devportf' ),
					'off' => __( 'Disable', 'devportf' )
					)	
			)
		)
	);

	/*============HOME PANEL============*/
	$wp_customize->add_panel(
		'devportf_home_panel',
		array(
			'title' => __( 'Home Sections', 'devportf' ),
			'priority' => 20
		)
	);

	/*============SLIDER IMAGES SECTION============*/
	$wp_customize->add_section(
		'devportf_slider_section',
		array(
			'title' => __( 'Home Slider', 'devportf' ),
			'panel' => 'devportf_home_panel',
		)
	);

	//SLIDERS
	for ( $i=1; $i < 4; $i++ ){

		$wp_customize->add_setting(
			'devportf_slider_heading'.$i,
			array(
				'sanitize_callback' => 'devportf_sanitize_text'
			)
		);

		$wp_customize->add_control(
			new devportf_Customize_Heading(
				$wp_customize,
				'devportf_slider_heading'.$i,
				array(
					'settings'		=> 'devportf_slider_heading'.$i,
					'section'		=> 'devportf_slider_section',
					'label'			=> __( 'Slider ', 'devportf' ).$i,
				)
			)
		);

		$wp_customize->add_setting(
			'devportf_slider_page'.$i,
			array(
				'sanitize_callback' => 'absint'
			)
		);

		$wp_customize->add_control(
			'devportf_slider_page'.$i,
			array(
				'settings'		=> 'devportf_slider_page'.$i,
				'section'		=> 'devportf_slider_section',
				'type'			=> 'dropdown-pages',
				'label'			=> __( 'Select a Page', 'devportf' ),	
			)
		);
		
	}

	$wp_customize->add_setting(
		'devportf_slider_info',
		array(
			'sanitize_callback' => 'devportf_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new devportf_Info_Text( 
			$wp_customize,
			'devportf_slider_info',
			array(
				'settings'		=> 'devportf_slider_info',
				'section'		=> 'devportf_slider_section',
				'label'			=> __( 'Note:', 'devportf' ),	
				'description'	=> __( 'The Page featured image works as a slider banner and the title & content work as a slider caption. <br/> Recommended Image Size: 1900X600', 'devportf' ),
			)
		)
	);

	/*============ABOUT US SECTION============*/
	$wp_customize->add_section(
		'devportf_about_section',
		array(
			'title' 			=> __( 'About Us Section', 'devportf' ),
			'panel'     		=> 'devportf_home_panel'
		)
	);

	//ENABLE/DISABLE ABOUT US PAGE
	$wp_customize->add_setting(
		'devportf_about_page_disable',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default' => 'off'
		)
	);

	$wp_customize->add_control(
		new devportf_Switch_Control(
			$wp_customize,
			'devportf_about_page_disable',
			array(
				'settings'		=> 'devportf_about_page_disable',
				'section'		=> 'devportf_about_section',
				'label'			=> __( 'Disable Section', 'devportf' ),
				'on_off_label' 	=> array(
					'on' => __( 'Yes', 'devportf' ),
					'off' => __( 'No', 'devportf' )
					)	
			)
		)
	);

	//ABOUT US PAGE
	$wp_customize->add_setting(
		'devportf_about_page',
		array(
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'devportf_about_page',
		array(
			'settings'		=> 'devportf_about_page',
			'section'		=> 'devportf_about_section',
			'type'			=> 'dropdown-pages',
			'label'			=> __( 'Select a Page', 'devportf' ),	
		)
	);

	for ( $i=1; $i < 6; $i++ ){ 
		$wp_customize->add_setting(
			'devportf_about_progressbar_heading'.$i,
			array(
				'sanitize_callback' => 'devportf_sanitize_text'
			)
		);

		$wp_customize->add_control(
			new devportf_Customize_Heading(
				$wp_customize,
				'devportf_about_progressbar_heading'.$i,
				array(
					'settings'		=> 'devportf_about_progressbar_heading'.$i,
					'section'		=> 'devportf_about_section',
					'label'			=> __( 'Progress Bar ', 'devportf' ).$i,
				)
			)
		);

		$wp_customize->add_setting(
			'devportf_about_progressbar_disable'.$i,
			array(
				'sanitize_callback' => 'absint'
			)
		);

		$wp_customize->add_control(
			'devportf_about_progressbar_disable'.$i,
			array(
				'settings'		=> 'devportf_about_progressbar_disable'.$i,
				'section'		=> 'devportf_about_section',
				'label'			=> __( 'Check to Disable', 'devportf' ),
				'type' 			=> 'checkbox'
			)
		);
		
		$wp_customize->add_setting(
			'devportf_about_progressbar_title'.$i,
			array(
				'sanitize_callback' => 'devportf_sanitize_text',
				'default'			=> sprintf( __( 'Progress Bar %d', 'devportf') , $i )
			)
		);

		$wp_customize->add_control(
			'devportf_about_progressbar_title'.$i,
			array(
				'settings'		=> 'devportf_about_progressbar_title'.$i,
				'section'		=> 'devportf_about_section',
				'type'			=> 'text',
				'label'			=> __( 'Title', 'devportf' )
			)
		);

		$wp_customize->add_setting(
			'devportf_about_progressbar_percentage'.$i,
			array(
				'sanitize_callback' => 'devportf_sanitize_choices',
				'default'			=> rand( 60 , 100)
			)
		);

		$wp_customize->add_control(
			new devportf_Dropdown_Chooser(
				$wp_customize,
				'devportf_about_progressbar_percentage'.$i,
				array(
					'settings'		=> 'devportf_about_progressbar_percentage'.$i,
					'section'		=> 'devportf_about_section',
					'label'			=> __( 'Percentage', 'devportf' ),
					'choices'       => $devportf_percentage
				)
			)
		);

		$wp_customize->add_setting(
			'devportf_about_image_heading',
			array(
				'sanitize_callback' => 'devportf_sanitize_text'
			)
		);

		$wp_customize->add_control(
			new devportf_Customize_Heading(
				$wp_customize,
				'devportf_about_image_heading',
				array(
					'settings'		=> 'devportf_about_image_heading',
					'section'		=> 'devportf_about_section',
					'label'			=> __( 'Right Image', 'devportf' ),
				)
			)
		);

		$wp_customize->add_setting(
			'devportf_about_image',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'devportf_about_image',
		        array(
		            'section' => 'devportf_about_section',
		            'settings' => 'devportf_about_image',
		            'description' => __('Recommended Image Size: 500X600px', 'devportf')
		        )
		    )
		);

		$wp_customize->add_setting(
			'devportf_about_widget',
			array(
				'default'			=> '0',
				'sanitize_callback' => 'devportf_sanitize_choices'
			)
		);

		$wp_customize->add_control(
			'devportf_about_widget',
			array(
				'settings'		=> 'devportf_about_widget',
				'section'		=> 'devportf_about_section',
				'type'			=> 'select',
				'label'			=> __( 'Replace Image by widget', 'devportf' ),
				'choices'       => $devportf_widget_list
			)
		);

	}

	/*============FEATURED SECTION PANEL============*/
	$wp_customize->add_section(
		'devportf_featured_section',
		array(
			'title' 			=> __( 'Featured Section', 'devportf' ),
			'panel'				=> 'devportf_home_panel'
		)
	);

	//ENABLE/DISABLE FEATURED SECTION
	$wp_customize->add_setting(
		'devportf_featured_section_disable',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new devportf_Switch_Control(
			$wp_customize,
			'devportf_featured_section_disable',
			array(
				'settings'		=> 'devportf_featured_section_disable',
				'section'		=> 'devportf_featured_section',
				'label'			=> __( 'Disable Section', 'devportf' ),
				'on_off_label' 	=> array(
					'on' => __( 'Yes', 'devportf' ),
					'off' => __( 'No', 'devportf' )
					),
			)
		)
	);

	$wp_customize->add_setting(
		'devportf_featured_title_sub_title_heading',
		array(
			'sanitize_callback' => 'devportf_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new devportf_Customize_Heading(
			$wp_customize,
			'devportf_featured_title_sub_title_heading',
			array(
				'settings'		=> 'devportf_featured_title_sub_title_heading',
				'section'		=> 'devportf_featured_section',
				'label'			=> __( 'Section Title & Sub Title', 'devportf' ),
			)
		)
	);

	$wp_customize->add_setting(
		'devportf_featured_title',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default'			=> __( 'Featured Section', 'devportf' )
		)
	);

	$wp_customize->add_control(
		'devportf_featured_title',
		array(
			'settings'		=> 'devportf_featured_title',
			'section'		=> 'devportf_featured_section',
			'type'			=> 'text',
			'label'			=> __( 'Title', 'devportf' )
		)
	);

	$wp_customize->add_setting(
		'devportf_featured_sub_title',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default'			=> __( 'Featured Section SubTitle', 'devportf' )
		)
	);

	$wp_customize->add_control(
		'devportf_featured_sub_title',
		array(
			'settings'		=> 'devportf_featured_sub_title',
			'section'		=> 'devportf_featured_section',
			'type'			=> 'textarea',
			'label'			=> __( 'Sub Title', 'devportf' ),
		)
	);

	//FEATURED PAGES
	for( $i = 1; $i < 4; $i++ ){
		$wp_customize->add_setting(
			'devportf_featured_header'.$i,
			array(
				'sanitize_callback' => 'devportf_sanitize_text'
			)
		);

		$wp_customize->add_control(
			new devportf_Customize_Heading(
				$wp_customize,
				'devportf_featured_header'.$i,
				array(
					'settings'		=> 'devportf_featured_header'.$i,
					'section'		=> 'devportf_featured_section',
					'label'			=> __( 'Featured Page ', 'devportf' ).$i
				)
			)
		);

		$wp_customize->add_setting(
			'devportf_featured_page'.$i,
			array(
				'sanitize_callback' => 'absint'
			)
		);

		$wp_customize->add_control(
			'devportf_featured_page'.$i,
			array(
				'settings'		=> 'devportf_featured_page'.$i,
				'section'		=> 'devportf_featured_section',
				'type'			=> 'dropdown-pages',
				'label'			=> __( 'Select a Page', 'devportf' )
			)
		);

		$wp_customize->add_setting(
			'devportf_featured_page_icon'.$i,
			array(
				'default'			=> 'fa fa-bell',
				'sanitize_callback' => 'devportf_sanitize_text'
			)
		);

		$wp_customize->add_control(
			new devportf_Fontawesome_Icon_Chooser(
				$wp_customize,
				'devportf_featured_page_icon'.$i,
				array(
					'settings'		=> 'devportf_featured_page_icon'.$i,
					'section'		=> 'devportf_featured_section',
					'type'			=> 'icon',
					'label'			=> __( 'FontAwesome Icon', 'devportf' ),
				)
			)
		);
	}

	/*============PORTFOLIO SECTION PANEL============*/
	$wp_customize->add_section(
		'devportf_portfolio_section',
		array(
			'title'			=> __( 'Portfolio Section', 'devportf' ),
			'panel'         => 'devportf_home_panel'
		)
	);

	//ENABLE/DISABLE PORTFOLIO
	$wp_customize->add_setting(
		'devportf_portfolio_section_disable',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default' => 'off'
		)
	);

	$wp_customize->add_control(
		new devportf_Switch_Control(
			$wp_customize,
			'devportf_portfolio_section_disable',
			array(
				'settings'		=> 'devportf_portfolio_section_disable',
				'section'		=> 'devportf_portfolio_section',
				'label'			=> __( 'Disable Section', 'devportf' ),
				'on_off_label' 	=> array(
					'on' => __( 'Yes', 'devportf' ),
					'off' => __( 'No', 'devportf' )
					)	
			)
		)
	);

	$wp_customize->add_setting(
		'devportf_portfolio_title_sec_heading',
		array(
			'sanitize_callback' => 'devportf_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new devportf_Customize_Heading(
			$wp_customize,
			'devportf_portfolio_title_sec_heading',
			array(
				'settings'		=> 'devportf_portfolio_title_sec_heading',
				'section'		=> 'devportf_portfolio_section',
				'label'			=> __( 'Section Title & Sub Title', 'devportf' ),
			)
		)
	);

	$wp_customize->add_setting(
		'devportf_portfolio_title',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default'			=> __( 'Portfolio Section', 'devportf' )
		)
	);

	$wp_customize->add_control(
		'devportf_portfolio_title',
		array(
			'settings'		=> 'devportf_portfolio_title',
			'section'		=> 'devportf_portfolio_section',
			'type'			=> 'text',
			'label'			=> __( 'Title', 'devportf' )
		)
	);

	$wp_customize->add_setting(
		'devportf_portfolio_sub_title',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default'			=> __( 'Portfolio Section SubTitle', 'devportf' )
		)
	);

	$wp_customize->add_control(
		'devportf_portfolio_sub_title',
		array(
			'settings'		=> 'devportf_portfolio_sub_title',
			'section'		=> 'devportf_portfolio_section',
			'type'			=> 'textarea',
			'label'			=> __( 'Sub Title', 'devportf' )
		)
	);

	//PORTFOLIO CHOICES
	$wp_customize->add_setting(
		'devportf_portfolio_cat_heading',
		array(
			'sanitize_callback' => 'devportf_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new devportf_Customize_Heading(
			$wp_customize,
			'devportf_portfolio_cat_heading',
			array(
				'settings'		=> 'devportf_portfolio_cat_heading',
				'section'		=> 'devportf_portfolio_section',
				'label'			=> __( 'Portfolio Category', 'devportf' ),
			)
		)
	);

	$wp_customize->add_setting(
		'devportf_portfolio_cat',
		array(
			'sanitize_callback' => 'devportf_sanitize_text'
		)
	);
 
	$wp_customize->add_control(
	    new devportf_Customize_Checkbox_Multiple(
	        $wp_customize,
	        'devportf_portfolio_cat',
	        array(
	            'label' => __( 'Select Category', 'devportf' ),
	            'section' => 'devportf_portfolio_section',
	            'settings' => 'devportf_portfolio_cat',
	            'choices' => $devportf_cat
	        )
	    )
	);

	/*============SERVICE SECTION PANEL============*/
	$wp_customize->add_section(
		'devportf_service_section',
		array(
			'title' 			=> __( 'Service Section', 'devportf' ),
			'panel'				=> 'devportf_home_panel'
		)
	);

	//ENABLE/DISABLE SERVICE SECTION
	$wp_customize->add_setting(
		'devportf_service_section_disable',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default' => 'off'
		)
	);

	$wp_customize->add_control(
		new devportf_Switch_Control(
			$wp_customize,
			'devportf_service_section_disable',
			array(
				'settings'		=> 'devportf_service_section_disable',
				'section'		=> 'devportf_service_section',
				'label'			=> __( 'Disable Section', 'devportf' ),
				'on_off_label' 	=> array(
					'on' => __( 'Yes', 'devportf' ),
					'off' => __( 'No', 'devportf' )
					)	
			)
		)
	);

	$wp_customize->add_setting(
		'devportf_service_section_heading',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new devportf_Customize_Heading(
			$wp_customize,
			'devportf_service_section_heading',
			array(
				'settings'		=> 'devportf_service_section_heading',
				'section'		=> 'devportf_service_section',
				'label'			=> __( 'Section Title & Sub Title', 'devportf' ),
			)
		)
	);

	$wp_customize->add_setting(
		'devportf_service_title',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default'			=> __( 'Service Section', 'devportf' )
		)
	);

	$wp_customize->add_control(
		'devportf_service_title',
		array(
			'settings'		=> 'devportf_service_title',
			'section'		=> 'devportf_service_section',
			'type'			=> 'text',
			'label'			=> __( 'Title', 'devportf' )
		)
	);

	$wp_customize->add_setting(
		'devportf_service_sub_title',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default'			=> __( 'Service Section', 'devportf' )
		)
	);

	$wp_customize->add_control(
		'devportf_service_sub_title',
		array(
			'settings'		=> 'devportf_service_sub_title',
			'section'		=> 'devportf_service_section',
			'type'			=> 'textarea',
			'label'			=> __( 'Sub Title', 'devportf' )
		)
	);

	//SERVICE PAGES
	for( $i = 1; $i < 7; $i++ ){
		$wp_customize->add_setting(
			'devportf_service_header'.$i,
			array(
				'default'			=> '',
				'sanitize_callback' => 'devportf_sanitize_text'
			)
		);

		$wp_customize->add_control(
			new devportf_Customize_Heading(
				$wp_customize,
				'devportf_service_header'.$i,
				array(
					'settings'		=> 'devportf_service_header'.$i,
					'section'		=> 'devportf_service_section',
					'label'			=> __( 'Service Page ', 'devportf' ).$i
				)
			)
		);

		$wp_customize->add_setting(
			'devportf_service_page'.$i,
			array(
				'default'			=> '',
				'sanitize_callback' => 'absint'
			)
		);

		$wp_customize->add_control(
			'devportf_service_page'.$i,
			array(
				'settings'		=> 'devportf_service_page'.$i,
				'section'		=> 'devportf_service_section',
				'type'			=> 'dropdown-pages',
				'label'			=> __( 'Select a Page', 'devportf' )
			)
		);

		$wp_customize->add_setting(
			'devportf_service_page_icon'.$i,
			array(
				'default'			=> 'fa-bell',
				'sanitize_callback' => 'devportf_sanitize_text'
			)
		);

		$wp_customize->add_control(
			new devportf_Fontawesome_Icon_Chooser(
				$wp_customize,
				'devportf_service_page_icon'.$i,
				array(
					'settings'		=> 'devportf_service_page_icon'.$i,
					'section'		=> 'devportf_service_section',
					'type'			=> 'icon',
					'label'			=> __( 'FontAwesome Icon', 'devportf' )
				)
			)
		);
	}
	$wp_customize->add_setting(
		'devportf_service_left_bg_heading',
		array(
			'sanitize_callback' => 'devportf_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new devportf_Customize_Heading(
			$wp_customize,
			'devportf_service_left_bg_heading',
			array(
				'settings'		=> 'devportf_service_left_bg_heading',
				'section'		=> 'devportf_service_section',
				'label'			=> __( 'Left Image', 'devportf' ),
			)
		)
	);

	$wp_customize->add_setting(
		'devportf_service_left_bg',
		array(
			'sanitize_callback' => 'esc_url_raw',
			'default'			=> get_template_directory_uri().'/images/banner.jpg'
		)
	);
 
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'devportf_service_left_bg',
	        array(
	            'section' => 'devportf_service_section',
	            'settings' => 'devportf_service_left_bg',
	            'description' => __('Recommended Image Size: 770X650px', 'devportf')
	        )
	    )
	);

	/*============TEAM SECTION PANEL============*/
	$wp_customize->add_section(
		'devportf_team_section',
		array(
			'title'			=> __( 'Team Section', 'devportf' ),
			'panel'         => 'devportf_home_panel'
		)
	);

	//ENABLE/DISABLE TEAM SECTION
	$wp_customize->add_setting(
		'devportf_team_section_disable',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default' => 'off'
		)
	);

	$wp_customize->add_control(
		new devportf_Switch_Control(
			$wp_customize,
			'devportf_team_section_disable',
			array(
				'settings'		=> 'devportf_team_section_disable',
				'section'		=> 'devportf_team_section',
				'label'			=> __( 'Disable Section', 'devportf' ),
				'on_off_label' 	=> array(
					'on' => __( 'Yes', 'devportf' ),
					'off' => __( 'No', 'devportf' )
					)	
			)
		)
	);

	$wp_customize->add_setting(
		'devportf_team_title_subtitle_heading',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new devportf_Customize_Heading(
			$wp_customize,
			'devportf_team_title_subtitle_heading',
			array(
				'settings'		=> 'devportf_team_title_subtitle_heading',
				'section'		=> 'devportf_team_section',
				'label'			=> __( 'Section Title & Sub Title', 'devportf' ),
			)
		)
	);

	$wp_customize->add_setting(
		'devportf_team_title',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default'			=> __( 'Team Section', 'devportf' )
		)
	);

	$wp_customize->add_control(
		'devportf_team_title',
		array(
			'settings'		=> 'devportf_team_title',
			'section'		=> 'devportf_team_section',
			'type'			=> 'text',
			'label'			=> __( 'Title', 'devportf' )
		)
	);

	$wp_customize->add_setting(
		'devportf_team_sub_title',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default'			=> __( 'Team Section SubTitle', 'devportf' )
		)
	);

	$wp_customize->add_control(
		'devportf_team_sub_title',
		array(
			'settings'		=> 'devportf_team_sub_title',
			'section'		=> 'devportf_team_section',
			'type'			=> 'textarea',
			'label'			=> __( 'Sub Title', 'devportf' )
		)
	);

	//TEAM PAGES
	for( $i = 1; $i < 5; $i++ ){
		$wp_customize->add_setting(
			'devportf_team_heading'.$i,
			array(
				'sanitize_callback' => 'devportf_sanitize_text'
			)
		);

		$wp_customize->add_control(
			new devportf_Customize_Heading(
				$wp_customize,
				'devportf_team_heading'.$i,
				array(
					'settings'		=> 'devportf_team_heading'.$i,
					'section'		=> 'devportf_team_section',
					'label'			=> __( 'Team Member ', 'devportf' ).$i,
				)
			)
		);

		$wp_customize->add_setting(
			'devportf_team_page'.$i,
			array(
				'sanitize_callback' => 'absint'
			)
		);

		$wp_customize->add_control(
			'devportf_team_page'.$i,
			array(
				'settings'		=> 'devportf_team_page'.$i,
				'section'		=> 'devportf_team_section',
				'type'			=> 'dropdown-pages',
				'label'			=> __( 'Select a Page', 'devportf' )
			)
		);

		$wp_customize->add_setting(
			'devportf_team_designation'.$i,
			array(
				'sanitize_callback' => 'devportf_sanitize_text'
			)
		);

		$wp_customize->add_control(
			'devportf_team_designation'.$i,
			array(
				'settings'		=> 'devportf_team_designation'.$i,
				'section'		=> 'devportf_team_section',
				'type'			=> 'text',
				'label'			=> __( 'Team Member Designation', 'devportf' )
			)
		);

		$wp_customize->add_setting(
			'devportf_team_facebook'.$i,
			array(
				'default'			=> 'https://facebook.com',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
			'devportf_team_facebook'.$i,
			array(
				'settings'		=> 'devportf_team_facebook'.$i,
				'section'		=> 'devportf_team_section',
				'type'			=> 'url',
				'label'	        => __( 'Facebook Url', 'devportf' )
			)
		);

		$wp_customize->add_setting(
			'devportf_team_twitter'.$i,
			array(
				'default'			=> 'https://twitter.com',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
			'devportf_team_twitter'.$i,
			array(
				'settings'		=> 'devportf_team_twitter'.$i,
				'section'		=> 'devportf_team_section',
				'type'			=> 'url',
				'label'	        => __( 'Twitter Url', 'devportf' )
			)
		);

		$wp_customize->add_setting(
			'devportf_team_google_plus'.$i,
			array(
				'default'			=> 'https://plus.google.com',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
			'devportf_team_google_plus'.$i,
			array(
				'settings'		=> 'devportf_team_google_plus'.$i,
				'section'		=> 'devportf_team_section',
				'type'			=> 'url',
				'label'	        => __( 'Google Plus Url', 'devportf' )
			)
		);

		$wp_customize->add_setting(
			'devportf_team_linkedin'.$i,
			array(
				'default'			=> 'https://linkedin.com',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
			'devportf_team_linkedin'.$i,
			array(
				'settings'		=> 'devportf_team_linkedin'.$i,
				'section'		=> 'devportf_team_linkedin'.$i,
				'type'			=> 'url',
				'label'	        => __( 'Linkedin Url', 'devportf' )
			)
		);
	}

	/*============COUNTER SECTION PANEL============*/
	$wp_customize->add_section(
		'devportf_counter_section',
		array(
			'title' 			=> __( 'Counter Section', 'devportf' ),
			'panel'				=> 'devportf_home_panel'
		)
	);

	$wp_customize->add_setting(
		'devportf_counter_title_subtitle_heading',
		array(
			'sanitize_callback' => 'devportf_sanitize_text'
		)
	);

	//ENABLE/DISABLE COUNTER SECTION
	$wp_customize->add_setting(
		'devportf_counter_section_disable',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default' => 'off'
		)
	);

	$wp_customize->add_control(
		new devportf_Switch_Control(
			$wp_customize,
			'devportf_counter_section_disable',
			array(
				'settings'		=> 'devportf_counter_section_disable',
				'section'		=> 'devportf_counter_section',
				'label'			=> __( 'Disable Section', 'devportf' ),
				'on_off_label' 	=> array(
					'on' => __( 'Yes', 'devportf' ),
					'off' => __( 'No', 'devportf' )
					)	
			)
		)
	);

	$wp_customize->add_control(
		new devportf_Customize_Heading(
			$wp_customize,
			'devportf_counter_title_subtitle_heading',
			array(
				'settings'		=> 'devportf_counter_title_subtitle_heading',
				'section'		=> 'devportf_counter_section',
				'label'			=> __( 'Section Title & Sub Title', 'devportf' ),
			)
		)
	);

	$wp_customize->add_setting(
		'devportf_counter_title',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default'			=> __( 'Counter Section', 'devportf' )
		)
	);

	$wp_customize->add_control(
		'devportf_counter_title',
		array(
			'settings'		=> 'devportf_counter_title',
			'section'		=> 'devportf_counter_section',
			'type'			=> 'text',
			'label'			=> __( 'Title', 'devportf' )
		)
	);

	$wp_customize->add_setting(
		'devportf_counter_sub_title',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default'			=> __( 'Counter Section SubTitle', 'devportf' )
		)
	);

	$wp_customize->add_control(
		'devportf_counter_sub_title',
		array(
			'settings'		=> 'devportf_counter_sub_title',
			'section'		=> 'devportf_counter_section',
			'type'			=> 'textarea',
			'label'			=> __( 'Sub Title', 'devportf' )
		)
	);

	$wp_customize->add_setting(
		'devportf_counter_bg_heading',
		array(
			'sanitize_callback' => 'devportf_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new devportf_Customize_Heading(
			$wp_customize,
			'devportf_counter_bg_heading',
			array(
				'settings'		=> 'devportf_counter_bg_heading',
				'section'		=> 'devportf_counter_section',
				'label'			=> __( 'Section Background', 'devportf' ),
			)
		)
	);

	$wp_customize->add_setting(
		'devportf_counter_bg',
		array(
			'sanitize_callback' => 'esc_url_raw',
			'default'			=> get_template_directory_uri().'/images/banner.jpg'
		)
	);

	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'devportf_counter_bg',
	        array(
	            'label' => __( 'Upload Image', 'devportf' ),
	            'section' => 'devportf_counter_section',
	            'settings' => 'devportf_counter_bg',
	            'description' => __('Recommended Image Size: 1800X400px', 'devportf')
	        )
	    )
	);

	//COUNTERS
	for( $i = 1; $i < 5; $i++ ){

		$wp_customize->add_setting(
			'devportf_counter_heading'.$i,
			array(
				'sanitize_callback' => 'devportf_sanitize_text'
			)
		);

		$wp_customize->add_control(
			new devportf_Customize_Heading(
				$wp_customize,
				'devportf_counter_heading'.$i,
				array(
					'settings'		=> 'devportf_counter_heading'.$i,
					'section'		=> 'devportf_counter_section',
					'label'			=> __( 'Counter', 'devportf' ).$i,
				)
			)
		);

		$wp_customize->add_setting(
			'devportf_counter_title'.$i,
			array(
				'sanitize_callback' => 'devportf_sanitize_text'
			)
		);

		$wp_customize->add_control(
			'devportf_counter_title'.$i,
			array(
				'settings'		=> 'devportf_counter_title'.$i,
				'section'		=> 'devportf_counter_section',
				'type'			=> 'text',
				'label'			=> __( 'Title', 'devportf' )
			)
		);

		$wp_customize->add_setting(
			'devportf_counter_count'.$i,
			array(
				'sanitize_callback' => 'absint'
			)
		);

		$wp_customize->add_control(
			'devportf_counter_count'.$i,
			array(
				'settings'		=> 'devportf_counter_count'.$i,
				'section'		=> 'devportf_counter_section',
				'type'			=> 'number',
				'label'			=> __( 'Counter Value', 'devportf' )
			)
		);

		$wp_customize->add_setting(
			'devportf_counter_icon'.$i,
			array(
				'default'			=> 'fa fa-bell',
				'sanitize_callback' => 'devportf_sanitize_text'
			)
		);

		$wp_customize->add_control(
			new devportf_Fontawesome_Icon_Chooser(
				$wp_customize,
				'devportf_counter_icon'.$i,
				array(
					'settings'		=> 'devportf_counter_icon'.$i,
					'section'		=> 'devportf_counter_section',
					'type'			=> 'icon',
					'label'			=> __( 'Counter Icon', 'devportf' )
				)
			)
		);
	}

	/*============TESTIMONIAL PANEL============*/
	$wp_customize->add_section(
		'devportf_testimonial_section',
		array(
			'title' 			=> __( 'Testimonial Section', 'devportf' ),
			'panel'  			=> 'devportf_home_panel'
		)
	);

	//ENABLE/DISABLE TESTIMONIAL SECTION
	$wp_customize->add_setting(
		'devportf_testimonial_section_disable',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default' => 'off'
		)
	);

	$wp_customize->add_control(
		new devportf_Switch_Control(
			$wp_customize,
			'devportf_testimonial_section_disable',
			array(
				'settings'		=> 'devportf_testimonial_section_disable',
				'section'		=> 'devportf_testimonial_section',
				'label'			=> __( 'Disable Section', 'devportf' ),
				'on_off_label' 	=> array(
					'on' => __( 'Yes', 'devportf' ),
					'off' => __( 'No', 'devportf' )
					)	
			)
		)
	);

	$wp_customize->add_setting(
		'devportf_testimonial_title_subtitle_heading',
		array(
			'sanitize_callback' => 'devportf_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new devportf_Customize_Heading(
			$wp_customize,
			'devportf_testimonial_title_subtitle_heading',
			array(
				'settings'		=> 'devportf_testimonial_title_subtitle_heading',
				'section'		=> 'devportf_testimonial_section',
				'label'			=> __( 'Section Title & Sub Title', 'devportf' ),
			)
		)
	);

	$wp_customize->add_setting(
		'devportf_testimonial_title',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default'			=> __( 'Testimonial Section', 'devportf' )
		)
	);

	$wp_customize->add_control(
		'devportf_testimonial_title',
		array(
			'settings'		=> 'devportf_testimonial_title',
			'section'		=> 'devportf_testimonial_section',
			'type'			=> 'text',
			'label'			=> __( 'Title', 'devportf' )
		)
	);

	$wp_customize->add_setting(
		'devportf_testimonial_sub_title',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default'			=> __( 'Testimonial Section SubTitle', 'devportf' )
		)
	);

	$wp_customize->add_control(
		'devportf_testimonial_sub_title',
		array(
			'settings'		=> 'devportf_testimonial_sub_title',
			'section'		=> 'devportf_testimonial_section',
			'type'			=> 'textarea',
			'label'			=> __( 'Sub Title', 'devportf' )
		)
	);

	//TESTIMONIAL PAGES
	$wp_customize->add_setting(
		'devportf_testimonial_header',
		array(
			'sanitize_callback' => 'devportf_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new devportf_Customize_Heading(
			$wp_customize,
			'devportf_testimonial_header',
			array(
				'settings'		=> 'devportf_testimonial_header',
				'section'		=> 'devportf_testimonial_section',
				'label'			=> __( 'Testimonial', 'devportf' )
			)
		)
	);

	$wp_customize->add_setting(
		'devportf_testimonial_page',
		array(
			'sanitize_callback' => 'devportf_sanitize_choices_array'
		)
	);

	$wp_customize->add_control(
		new devportf_Dropdown_Multiple_Chooser(
		$wp_customize,
		'devportf_testimonial_page',
		array(
			'settings'		=> 'devportf_testimonial_page',
			'section'		=> 'devportf_testimonial_section',
			'choices'		=> $devportf_page_choice,
			'label'			=> __( 'Select the Pages', 'devportf' ),
			'placeholder'   => __( 'Select Some Pages', 'devportf' )
 		)
		)
	);

	/*============BLOG PANEL============*/
	$wp_customize->add_section(
		'devportf_blog_section',
		array(
			'title' 			=> __( 'Blog Section', 'devportf' ),
			'panel'				=> 'devportf_home_panel'
		)
	);

	//ENABLE/DISABLE BLOG SECTION
	$wp_customize->add_setting(
		'devportf_blog_section_disable',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default' => 'off'
		)
	);

	$wp_customize->add_control(
		new devportf_Switch_Control(
			$wp_customize,
			'devportf_blog_section_disable',
			array(
				'settings'		=> 'devportf_blog_section_disable',
				'section'		=> 'devportf_blog_section',
				'label'			=> __( 'Disable Section', 'devportf' ),
				'on_off_label' 	=> array(
					'on' => __( 'Yes', 'devportf' ),
					'off' => __( 'No', 'devportf' )
					)	
			)
		)
	);

	$wp_customize->add_setting(
		'devportf_blog_title_subtitle_heading',
		array(
			'sanitize_callback' => 'devportf_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new devportf_Customize_Heading(
			$wp_customize,
			'devportf_blog_title_subtitle_heading',
			array(
				'settings'		=> 'devportf_blog_title_subtitle_heading',
				'section'		=> 'devportf_blog_section',
				'label'			=> __( 'Section Title & Sub Title', 'devportf' ),
			)
		)
	);

	$wp_customize->add_setting(
		'devportf_blog_title',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default'			=> __( 'Blog Section', 'devportf' )
		)
	);

	$wp_customize->add_control(
		'devportf_blog_title',
		array(
			'settings'		=> 'devportf_blog_title',
			'section'		=> 'devportf_blog_section',
			'type'			=> 'text',
			'label'			=> __( 'Title', 'devportf' )
		)
	);

	$wp_customize->add_setting(
		'devportf_blog_sub_title',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default'			=> __( 'Blog Section SubTitle', 'devportf' )
		)
	);

	$wp_customize->add_control(
		'devportf_blog_sub_title',
		array(
			'settings'		=> 'devportf_blog_sub_title',
			'section'		=> 'devportf_blog_section',
			'type'			=> 'textarea',
			'label'			=> __( 'Sub Title', 'devportf' )
		)
	);

	//BLOG SETTINGS
	$wp_customize->add_setting(
		'devportf_blog_post_count',
		array(
			'default'			=> '3',
			'sanitize_callback' => 'devportf_sanitize_choices'
		)
	);

	$wp_customize->add_control(
		new devportf_Dropdown_Chooser(
		$wp_customize,
		'devportf_blog_post_count',
		array(
			'settings'		=> 'devportf_blog_post_count',
			'section'		=> 'devportf_blog_section',
			'label'			=> __( 'Number of Posts to show', 'devportf' ),
			'choices'       => $devportf_post_count_choice
		)
		)
	);

	$wp_customize->add_setting(
		'devportf_blog_cat_exclude',
		array(
			'sanitize_callback' => 'devportf_sanitize_text'
		)
	);
 
	$wp_customize->add_control(
	    new devportf_Customize_Checkbox_Multiple(
	        $wp_customize,
	        'devportf_blog_cat_exclude',
	        array(
	            'label' => __('Exclude Category from Blog Posts', 'devportf'),
	            'section' => 'devportf_blog_section',
	            'settings' => 'devportf_blog_cat_exclude',
	            'choices' => $devportf_cat
	        )
	    )
	);

	/*============CLIENTS LOGO SECTION============*/
	$wp_customize->add_Section(
		'devportf_client_logo_section',
		array(
			'title' 			=> __( 'Clients Logo Section', 'devportf' ),
			'panel'				=> 'devportf_home_panel'
		)
	);

	//ENABLE/DISABLE LOGO SECTION
	$wp_customize->add_setting(
		'devportf_client_logo_section_disable',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default' => 'off'
		)
	);

	$wp_customize->add_control(
		new devportf_Switch_Control(
			$wp_customize,
			'devportf_client_logo_section_disable',
			array(
				'settings'		=> 'devportf_client_logo_section_disable',
				'section'		=> 'devportf_client_logo_section',
				'label'			=> __( 'Disable Section', 'devportf' ),
				'on_off_label' 	=> array(
					'on' => __( 'Yes', 'devportf' ),
					'off' => __( 'No', 'devportf' )
					)	
			)
		)
	);

	$wp_customize->add_setting(
		'devportf_client_logo_title_subtitle_heading',
		array(
			'sanitize_callback' => 'devportf_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new devportf_Customize_Heading(
			$wp_customize,
			'devportf_client_logo_title_subtitle_heading',
			array(
				'settings'		=> 'devportf_client_logo_title_subtitle_heading',
				'section'		=> 'devportf_client_logo_section',
				'label'			=> __( 'Section Title & Sub Title', 'devportf' ),
			)
		)
	);

	$wp_customize->add_setting(
		'devportf_logo_title',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default'			=> __( 'Client Logo Section', 'devportf' )
		)
	);

	$wp_customize->add_control(
		'devportf_logo_title',
		array(
			'settings'		=> 'devportf_logo_title',
			'section'		=> 'devportf_client_logo_section',
			'type'			=> 'text',
			'label'			=> __( 'Title', 'devportf' )
		)
	);

	$wp_customize->add_setting(
		'devportf_logo_sub_title',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default'			=> __( 'Clients Logo Section SubTitle', 'devportf' )
		)
	);

	$wp_customize->add_control(
		'devportf_logo_sub_title',
		array(
			'settings'		=> 'devportf_logo_sub_title',
			'section'		=> 'devportf_client_logo_section',
			'type'			=> 'textarea',
			'label'			=> __( 'Sub Title', 'devportf' )
		)
	);

	//CLIENTS LOGOS
	$wp_customize->add_setting(
		'devportf_client_logo_image',
		array(
			'sanitize_callback' => 'devportf_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new devportf_Display_Gallery_Control(
			$wp_customize,
			'devportf_client_logo_image',
		array(
			'settings'		=> 'devportf_client_logo_image',
			'section'		=> 'devportf_client_logo_section',
			'label'			=> __( 'Upload Clients Logos', 'devportf' ),
		)
		)
	);

	/*============CALL TO ACTION PANEL============*/
	$wp_customize->add_section(
		'devportf_cta_section',
		array(
			'title' 			=> __( 'Call To Action Section', 'devportf' ),
			'panel'				=> 'devportf_home_panel'
		)
	);

	//ENABLE/DISABLE LOGO SECTION
	$wp_customize->add_setting(
		'devportf_cta_section_disable',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default' => 'off'
		)
	);

	$wp_customize->add_control(
		new devportf_Switch_Control(
			$wp_customize,
			'devportf_cta_section_disable',
			array(
				'settings'		=> 'devportf_cta_section_disable',
				'section'		=> 'devportf_cta_section',
				'label'			=> __( 'Disable Section', 'devportf' ),
				'on_off_label' 	=> array(
					'on' => __( 'Yes', 'devportf' ),
					'off' => __( 'No', 'devportf' )
					)	
			)
		)
	);

	$wp_customize->add_setting(
		'devportf_cta_title',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default'			=> __( 'Call To Action Section', 'devportf' )
		)
	);

	$wp_customize->add_control(
		'devportf_cta_title',
		array(
			'settings'		=> 'devportf_cta_title',
			'section'		=> 'devportf_cta_section',
			'type'			=> 'text',
			'label'			=> __( 'Title', 'devportf' )
		)
	);

	$wp_customize->add_setting(
		'devportf_cta_sub_title',
		array(
			'sanitize_callback' => 'devportf_sanitize_text',
			'default'			=> __( 'Call To Action Section SubTitle', 'devportf' )
		)
	);

	$wp_customize->add_control(
		'devportf_cta_sub_title',
		array(
			'settings'		=> 'devportf_cta_sub_title',
			'section'		=> 'devportf_cta_section',
			'type'			=> 'textarea',
			'label'			=> __( 'Sub Title', 'devportf' )
		)
	);

	$wp_customize->add_setting(
		'devportf_cta_button1_text',
		array(
			'sanitize_callback' => 'devportf_sanitize_text'
		)
	);

	$wp_customize->add_control(
		'devportf_cta_button1_text',
		array(
			'settings'		=> 'devportf_cta_button1_text',
			'section'		=> 'devportf_cta_section',
			'type'			=> 'text',
			'label'			=> __( 'Button 1 Text', 'devportf' )
		)
	);

	$wp_customize->add_setting(
		'devportf_cta_button1_link',
		array(
			'default'			=> '',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control(
		'devportf_cta_button1_link',
		array(
			'settings'		=> 'devportf_cta_button1_link',
			'section'		=> 'devportf_cta_section',
			'type'			=> 'url',
			'label'			=> __( 'Button 1 Link', 'devportf' )
		)
	);

	$wp_customize->add_setting(
		'devportf_cta_button2_text',
		array(
			'default'			=> '',
			'sanitize_callback' => 'devportf_sanitize_text'
		)
	);

	$wp_customize->add_control(
		'devportf_cta_button2_text',
		array(
			'settings'		=> 'devportf_cta_button2_text',
			'section'		=> 'devportf_cta_section',
			'type'			=> 'text',
			'label'			=> __( 'Button 2 Text', 'devportf' )
		)
	);

	$wp_customize->add_setting(
		'devportf_cta_button2_link',
		array(
			'default'			=> '',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control(
		'devportf_cta_button2_link',
		array(
			'settings'		=> 'devportf_cta_button2_link',
			'section'		=> 'devportf_cta_section',
			'type'			=> 'url',
			'label'			=> __( 'Button 2 Link', 'devportf' )
		)
	);

	$wp_customize->add_setting(
		'devportf_cta_bg',
		array(
			'sanitize_callback' => 'esc_url_raw',
			'default'			=> get_template_directory_uri().'/images/banner.jpg'
		)
	);

	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'devportf_cta_bg',
	        array(
	            'label' => __( 'Background Image', 'devportf' ),
	            'section' => 'devportf_cta_section',
	            'settings' => 'devportf_cta_bg',
	            'description' => __('Recommended Image Size: 1800X800px', 'devportf')
	        )
	    )
	);

	/*============IMPORTANT LINKS============*/
    // TODO: fix documentation
	$wp_customize->add_section(
		'devportf_implink_section',
		array(
			'title' 			=> __( 'Important Links', 'devportf' ),
			'priority'			=> 1
		)
	);

	$wp_customize->add_setting(
		'devportf_imp_links',
		array(
			'sanitize_callback' => 'devportf_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new devportf_Info_Text( 
			$wp_customize,
			'devportf_imp_links',
			array(
				'settings'		=> 'devportf_imp_links',
				'section'		=> 'devportf_implink_section',
				'description'	=> '<a class="ht-implink" href="https://hashthemes.com/documentation/total-documentation/" target="_blank">'.__('Documentation', 'devportf').'</a><a class="ht-implink" href="http://demo.hashthemes.com/total/" target="_blank">'.__('Live Demo', 'devportf').'</a><a class="ht-implink" href="https://hashthemes.com/support/" target="_blank">'.__('Support Forum', 'devportf').'</a><a class="ht-implink" href="https://www.facebook.com/hashtheme/" target="_blank">'.__('Like Us in Facebook', 'devportf').'</a>',
			)
		)
	);

	$wp_customize->add_setting(
		'devportf_rate_us',
		array(
			'sanitize_callback' => 'devportf_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new devportf_Info_Text( 
			$wp_customize,
			'devportf_rate_us',
			array(
				'settings'		=> 'devportf_rate_us',
				'section'		=> 'devportf_implink_section',
				'description'	=> sprintf(__( 'Please do rate original Total theme if you liked it %s', 'devportf'), '<a class="ht-implink" href="https://wordpress.org/support/theme/total/reviews/?filter=5" target="_blank">Rate/Review</a>' ),
			)
		)
	);

	$wp_customize->add_setting(
		'devportf_setup_instruction',
		array(
			'sanitize_callback' => 'devportf_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new devportf_Info_Text( 
			$wp_customize,
			'devportf_setup_instruction',
			array(
				'settings'		=> 'devportf_setup_instruction',
				'section'		=> 'devportf_implink_section',
				'description'	=> __( '<strong>Instruction - Setting up Home Page</strong><br/>1. Create a new 
					page (any title, like Home )<br/>
2. In right column: Page Attributes -> Template: Home Page<br/>
3. Click on Publish<br/>
4. Go to Appearance-> Customize -> General settings -> Static Front Page<br/>
5. Select - A static page<br/>
6. In Front Page, select the page that you created in the step 1<br/>
7. Save changes', 'devportf'),
			)
		)
	);

}
add_action( 'customize_register', 'devportf_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function devportf_customize_preview_js() {
	wp_enqueue_script( 'devportf-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'devportf_customize_preview_js' );

function devportf_customizer_script() {
	wp_enqueue_script( 'devportf-customizer-script', get_template_directory_uri() .'/inc/js/customizer-scripts.js', array("jquery"),'', true  );
	wp_enqueue_script( 'devportf-customizer-chosen-script', get_template_directory_uri() .'/inc/js/chosen.jquery.js', array("jquery"),'1.4.1', true  );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/css/font-awesome.css');	
	wp_enqueue_style( 'devportf-customizer-chosen-style', get_template_directory_uri() .'/inc/css/chosen.css');
	wp_enqueue_style( 'devportf-customizer-style', get_template_directory_uri() .'/inc/css/customizer-style.css');	
}
add_action( 'customize_controls_enqueue_scripts', 'devportf_customizer_script' );

if( class_exists( 'WP_Customize_Control' ) ):	

class devportf_Dropdown_Chooser extends WP_Customize_Control{
	public $type = 'dropdown_chooser';

	public function render_content(){
		if ( empty( $this->choices ) )
                return;
		?>
            <label>
                <span class="customize-control-title">
                	<?php echo esc_html( $this->label ); ?>
                </span>

                <?php if($this->description){ ?>
	            <span class="description customize-control-description">
	            	<?php echo wp_kses_post($this->description); ?>
	            </span>
	            <?php } ?>

                <select class="hs-chosen-select" <?php $this->link(); ?>>
                    <?php
                    foreach ( $this->choices as $value => $label )
                        echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . esc_html( $label ) . '</option>';
                    ?>
                </select>
            </label>
		<?php
	}
}

class devportf_Fontawesome_Icon_Chooser extends WP_Customize_Control{
	public $type = 'icon';

	public function render_content(){
		?>
            <label>
                <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
                </span>

                <?php if($this->description){ ?>
	            <span class="description customize-control-description">
	            	<?php echo wp_kses_post($this->description); ?>
	            </span>
	            <?php } ?>

                <div class="devportf-selected-icon">
                	<i class="fa <?php echo esc_attr($this->value()); ?>"></i>
                	<span><i class="fa fa-angle-down"></i></span>
                </div>

                <ul class="devportf-icon-list clearfix">
                	<?php
                	$devportf_font_awesome_icon_array = devportf_font_awesome_icon_array();
                	foreach ($devportf_font_awesome_icon_array as $devportf_font_awesome_icon) {
							$icon_class = $this->value() == $devportf_font_awesome_icon ? 'icon-active' : '';
							echo '<li class='.$icon_class.'><i class="'.$devportf_font_awesome_icon.'"></i></li>';
						}
                	?>
                </ul>
                <input type="hidden" value="<?php $this->value(); ?>" <?php $this->link(); ?> />
            </label>
		<?php
	}
}

class devportf_Display_Gallery_Control extends WP_Customize_Control{
	public $type = 'gallery';
	 
	public function render_content() {
	?>
	<label>
		<span class="customize-control-title">
			<?php echo esc_html( $this->label ); ?>
		</span>

		<?php if($this->description){ ?>
			<span class="description customize-control-description">
			<?php echo wp_kses_post($this->description); ?>
			</span>
		<?php } ?>

		<div class="gallery-screenshot clearfix">
    	<?php
        	{
        	$ids = explode( ',', $this->value() );
            	foreach ( $ids as $attachment_id ) {
                	$img = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );
                	echo '<div class="screen-thumb"><img src="' . esc_url($img[0]) . '" /></div>';
            	}
        	}
    	?>
    	</div>

    	<input id="edit-gallery" class="button upload_gallery_button" type="button" value="<?php _e('Add/Edit Gallery','devportf') ?>" />
		<input id="clear-gallery" class="button upload_gallery_button" type="button" value="<?php _e('Clear','devportf') ?>" />
		<input type="hidden" class="gallery_values" <?php echo $this->link() ?> value="<?php echo esc_attr( $this->value() ); ?>">
	</label>
	<?php
	}
}

class devportf_Customize_Checkbox_Multiple extends WP_Customize_Control {
    public $type = 'checkbox-multiple';

    public function render_content() {

        if ( empty( $this->choices ) )
            return; ?>

        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

        <?php if ( !empty( $this->description ) ) : ?>
            <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
        <?php endif; ?>

        <?php $multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>

        <ul>
            <?php foreach ( $this->choices as $value => $label ) : ?>

                <li>
                    <label>
                        <input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> /> 
                        <?php echo esc_html( $label ); ?>
                    </label>
                </li>

            <?php endforeach; ?>
        </ul>

        <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
    <?php }
}

class devportf_Customize_Heading extends WP_Customize_Control {
	public $type = 'heading';

    public function render_content() {
    	if ( !empty( $this->label ) ) : ?>
            <h3 class="devportf-accordion-section-title"><?php echo esc_html( $this->label ); ?></h3>
        <?php endif;

        if($this->description){ ?>
			<span class="description customize-control-description">
			<?php echo wp_kses_post($this->description); ?>
			</span>
		<?php }
    }
}

class devportf_Dropdown_Multiple_Chooser extends WP_Customize_Control{
	public $type = 'dropdown_multiple_chooser';
	public $placeholder = '';

	public function __construct($manager, $id, $args = array()){
        $this->placeholder = $args['placeholder'];

        parent::__construct( $manager, $id, $args );
    }

	public function render_content(){
		if ( empty( $this->choices ) )
                return;
		?>
            <label>
                <span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>

				<?php if($this->description){ ?>
					<span class="description customize-control-description">
					<?php echo wp_kses_post($this->description); ?>
					</span>
				<?php }
				?>

                <select data-placeholder="<?php echo esc_html( $this->placeholder ); ?>" multiple="multiple" class="hs-chosen-select" <?php $this->link(); ?>>
                    <?php
                    foreach ( $this->choices as $value => $label ){
                    	$selected = '';
                    	if(in_array($value, $this->value())){
                    		$selected = 'selected="selected"';
                    	}
                        echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . esc_html($label) . '</option>';
                    }
                    ?>
                </select>
            </label>
		<?php
	}
}

class devportf_Category_Dropdown extends WP_Customize_Control{
    private $cats = false;

    public function __construct($manager, $id, $args = array(), $options = array()){
        $this->cats = get_categories($options);

        parent::__construct( $manager, $id, $args );
    }

    public function render_content(){
        if(!empty($this->cats)){
            ?>
            <label>
                <span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>

				<?php if($this->description){ ?>
					<span class="description customize-control-description">
					<?php echo wp_kses_post($this->description); ?>
					</span>
				<?php } ?>

                <select <?php $this->link(); ?>>
                   <?php
                    foreach ( $this->cats as $cat )
                    {
                        printf('<option value="%s" %s>%s</option>', esc_attr($cat->term_id), selected($this->value(), $cat->term_id, false), esc_html($cat->name));
                    }
                   ?>
                </select>
            </label>
        <?php
        }
    }
}

class devportf_Switch_Control extends WP_Customize_Control{
	public $type = 'switch';
	public $on_off_label = array();

	public function __construct($manager, $id, $args = array() ){
        $this->on_off_label = $args['on_off_label'];
        parent::__construct( $manager, $id, $args );
    }

	public function render_content(){
    ?>
	    <span class="customize-control-title">
			<?php echo esc_html( $this->label ); ?>
		</span>

		<?php if($this->description){ ?>
			<span class="description customize-control-description">
			<?php echo wp_kses_post($this->description); ?>
			</span>
		<?php } ?>

		<?php
			$switch_class = ($this->value() == 'on') ? 'switch-on' : '';
			$on_off_label = $this->on_off_label;
		?>
		<div class="onoffswitch <?php echo $switch_class; ?>">
			<div class="onoffswitch-inner">
				<div class="onoffswitch-active">
					<div class="onoffswitch-switch"><?php echo esc_html($on_off_label['on']) ?></div>
				</div>

				<div class="onoffswitch-inactive">
					<div class="onoffswitch-switch"><?php echo esc_html($on_off_label['off']) ?></div>
				</div>
			</div>	
		</div>
		<input <?php $this->link(); ?> type="hidden" value="<?php echo esc_attr($this->value()); ?>"/>
		<?php
    }
}

class devportf_Info_Text extends WP_Customize_Control{

    public function render_content(){
    ?>
	    <span class="customize-control-title">
			<?php echo esc_html( $this->label ); ?>
		</span>

		<?php if($this->description){ ?>
			<span class="description customize-control-description">
			<?php echo wp_kses_post($this->description); ?>
			</span>
		<?php }
    }

}

endif;


//SANITIZATION FUNCTIONS
function devportf_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function devportf_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

function devportf_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

function devportf_sanitize_choices( $input, $setting ) {
    global $wp_customize;
 
    $control = $wp_customize->get_control( $setting->id );
 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function devportf_sanitize_choices_array( $input, $setting ) {
    global $wp_customize;
 	
 	if(!empty($input)){
    	$input = array_map('absint', $input);
    }

    return $input;
} 