<?php
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly
// Remove p tags from content
remove_filter('the_content', 'wpautop');

add_theme_support('menus');

// Return formatted main-nav menu
function main_nav_menu() {
    $menu = wp_get_nav_menu_items('main-nav');
    $result = [];
    foreach($menu as $item) {
        $my_item = [
            'name' => $item->title,
            'href' => $item->url,
            'classes' => $item->classes
        ];
        $result[] = $my_item;
    }
    return $result;
}
// add endpoint
add_action( 'rest_api_init', function() {
    // top-nav menu
    register_rest_route( 'wp/v2', 'main-nav', array(
        'methods' => 'GET',
        'callback' => 'main_nav_menu',
    ) );
});


// Return formatted footer-nav menu
function footer_nav_menu() {
    $menu = wp_get_nav_menu_items('footer-nav');
    $result = [];
    foreach($menu as $item) {
        $my_item = [
            'name' => $item->title,
            'href' => $item->url
        ];
        $result[] = $my_item;
    }
    return $result;
}
// add endpoint
add_action( 'rest_api_init', function() {
    // top-nav menu
    register_rest_route( 'wp/v2', 'footer-nav', array(
        'methods' => 'GET',
        'callback' => 'footer_nav_menu',
    ) );
});