<?php
/**
 * devportf functions and definitions
 *
 * @package devportf
 */

if ( ! function_exists( 'devportf_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function devportf_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on devportf, use a find and replace
	 * to change 'devportf' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'devportf', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'devportf-portfolio-thumb', 400, 400, true );
	add_image_size( 'devportf-team-thumb', 350, 420, true );
	add_image_size( 'devportf-blog-thumb', 400, 280, true );
	add_image_size( 'devportf-thumb', 100, 100, true );
	add_image_size( 'devportf-blog-header', 720, 360, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'devportf' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
// 2018-01-13: disabled for test
//	add_theme_support( 'custom-background', apply_filters( 'devportf_custom_background_args', array(
//		'default-color' => 'ffffff',
//		'default-image' => '',
//	) ) );

	add_theme_support( 'custom-logo', array(
		'height'      => 62,
		'width'       => 300,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( '.ht-site-title', '.ht-site-description' ),
	) );

	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', devportf_fonts_url() ) );
}
endif; // devportf_setup
add_action( 'after_setup_theme', 'devportf_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function devportf_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'devportf_content_width', 640 );
}
add_action( 'after_setup_theme', 'devportf_content_width', 0 );

/**
 * Enables the Excerpt meta box in Page edit screen.
 */
function devportf_add_excerpt_support_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'devportf_add_excerpt_support_for_pages' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function devportf_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'devportf' ),
		'id'            => 'devportf-right-sidebar',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'devportf' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'devportf' ),
		'id'            => 'devportf-left-sidebar',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'devportf' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'devportf' ),
		'id'            => 'devportf-shop-sidebar',
		'description'   => __( 'Add widgets here to appear in your sidebar of shop page.', 'devportf' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer One', 'devportf' ),
		'id'            => 'devportf-footer1',
		'description'   => __( 'Add widgets here to appear in your Footer.', 'devportf' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Two', 'devportf' ),
		'id'            => 'devportf-footer2',
		'description'   => __( 'Add widgets here to appear in your Footer.', 'devportf' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Three', 'devportf' ),
		'id'            => 'devportf-footer3',
		'description'   => __( 'Add widgets here to appear in your Footer.', 'devportf' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Four', 'devportf' ),
		'id'            => 'devportf-footer4',
		'description'   => __( 'Add widgets here to appear in your Footer.', 'devportf' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'devportf_widgets_init' );

if ( ! function_exists( 'devportf_fonts_url' ) ) :
/**
 * Register Google fonts for devportf.
 *
 * @since Total 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function devportf_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Open Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Pontano Sans font: on or off', 'devportf' ) ) {
		$fonts[] = 'Pontano+Sans';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Oswald font: on or off', 'devportf' ) ) {
		$fonts[] = 'Oswald:400,700,300';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'devportf' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' =>  implode( '|', $fonts ) ,
			'subset' =>  $subsets ,
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles.
 */
function devportf_scripts() {
    wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/js/SmoothScroll.js', array(), '1.00', false );
    wp_enqueue_script( 'jquery-nav', get_template_directory_uri() . '/js/jquery.nav.js', array('jquery'), '1.00', true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), '1.00', true );
	wp_enqueue_script( 'isotope-pkgd', get_template_directory_uri() . '/js/isotope.pkgd.js', array('jquery', 'imagesloaded' ), '1.00', true );
	wp_enqueue_script( 'nivo-lightbox', get_template_directory_uri() . '/js/nivo-lightbox.js', array('jquery'), '1.00', true );
	wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery'), '1.00', true );
	wp_enqueue_script( 'jquery-stellar', get_template_directory_uri() . '/js/jquery.stellar.js', array('imagesloaded'), '1.00', false );  
    wp_enqueue_script( 'wow', get_template_directory_uri() . '/js/wow.js', array('jquery'), '1.00', true );
    wp_enqueue_script( 'odometer', get_template_directory_uri() . '/js/odometer.js', array('jquery'), '1.00', true );
    wp_enqueue_script( 'waypoint', get_template_directory_uri() . '/js/waypoint.js', array('jquery'), '1.00', true );
    wp_enqueue_script( 'devportf-custom', get_template_directory_uri() . '/js/devportf-custom.js', array('jquery'), '1.01', true );
	wp_localize_script( 'devportf-custom', 'devportf_localize', array('template_path' => get_template_directory_uri() )); 
	
	//wp_enqueue_style( 'devportf-style', get_stylesheet_uri(), array( 'animate', 'font-awesome', 'owl-carousel', 'nivo-lightbox', 'superfish'), '1.0' );
    wp_enqueue_style( 'devportf-style', get_template_directory_uri() . '/css/style.css', array( 'animate', 'font-awesome', 'owl-carousel', 'nivo-lightbox', 'superfish'), '1.0' );
	wp_enqueue_style( 'devportf-fonts', devportf_fonts_url(), array(), null );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css', array(), '1.0' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '4.4.0' );
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), '1.3.3' );
	wp_enqueue_style( 'nivo-lightbox', get_template_directory_uri() . '/css/nivo-lightbox.css', array(), '1.3.3' );
	wp_enqueue_style( 'superfish', get_template_directory_uri() . '/css/superfish.css', array(), '1.3.3' );
	// 2018-01-13 removed inline theme color styles: wp_add_inline_style( 'devportf-style', devportf_dymanic_styles() );
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'devportf_scripts' );

/**
 * Enqueue admin style
 */
function devportf_admin_scripts($hook) {
	wp_enqueue_style( 'devportf-admin-style', get_template_directory_uri() . '/inc/css/admin-style.css', array(), '1.0' );

	if($hook == 'widget.php'){
		wp_enqueue_media();
		wp_enqueue_script( 'devportf-admin-scripts', get_template_directory_uri() . '/inc/js/admin-scripts.js', array('jquery'), '1.00', true );
	}
}
add_action( 'admin_enqueue_scripts', 'devportf_admin_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/devportf-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Metabox additions.
 */
require get_template_directory() . '/inc/devportf-metabox.php';

/**
 * FontAwesome Array
 */
require get_template_directory() . '/inc/font-awesome-list.php';

/**
 * Dynamic Styles additions.
 */
// 2018-01-13 inline stiles - no need for it anymore
// require get_template_directory() . '/inc/style.php';

/**
 * Adds TGMPA Class
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'devportf_register_required_plugins' );

function devportf_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
//		// This is an example of how to include a plugin from the WordPress Plugin Repository.
//		array(
//			'name'      => 'Elementor',
//			'slug'      => 'elementor',
//			'required'  => false,
//		)

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

// 2018-01-15 - removed
//if ( ! defined( 'ELEMENTOR_PARTNER_ID' ) ) {
//	define( 'ELEMENTOR_PARTNER_ID', 2119 );
//}