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

if(get_theme_mod('devportf_register_pptype')) {
    add_action( 'init', 'devportf_register_my_post_types' ); 
}

function devportf_register_my_post_types() {
    
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
    register_post_type( get_theme_mod('devportf_portfolio_type'), $args );
    
    //flush_rewrite_rules();
}

function devportf_portfolio_is_set() {
    return get_theme_mod('devportf_portfolio_type') != '';
}