<?php
/**
 * Basic functionality for custom portfolio post type
 *
 * @package Total
 */

//class devportf_PPType {
//    public $selected = '';
//    public $used = '';
//    
//}
//
//$devportf_pptype = new devportf_PPType();
//$devportf_pptype->selected = 'portfolio';
//$devportf_pptype->used = get_theme_mod('devportf_portfolio_type');


add_action( 'init', 'devportf_register_my_post_types' ); 


function devportf_register_my_post_types() {
    if(get_theme_mod('devportf_register_pptype')) {
        $labels = array(
            'name' => 'Portfolio',
            'singular_name' => 'Portfolio', 
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Portfolio Item',
            'edit_item' => 'Edit Portfolio Item',
            'new_item' => 'New Portfolio Item',
            'all_items' => 'All Portfolio',
            'view_item' => 'View Portfolio Item',
            'search_items' => 'Search Portfolio',
            'not_found' => 'No portfolio items found', 
            'not_found_in_trash' => 'No portfolio items found in Trash',
            'menu_name' => 'Portfolio' 
        ); 
        $supports = array ('title', 'editor', 'excerpt', 'thumbnail');
        $args = array( 
            'labels' =>  $labels,
            'supports' => $supports,
            'has_archive' => true,
            'taxonomies' => array('category'),
            'public' => true 
        ); 
        $pptype = get_theme_mod('devportf_portfolio_type');
        register_post_type( $pptype, $args );
    } else {
        $pptype = "";
    }
    if($pptype != get_theme_mod('devportf_last_registered_type')) {
        flush_rewrite_rules();
        set_theme_mod('devportf_last_registered_type', $pptype);
    }
    
}

function devportf_portfolio_is_set() {
    return get_theme_mod('devportf_portfolio_type') != '';
}