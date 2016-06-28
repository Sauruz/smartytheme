<?php

//function add_custom_post_types() {
//    // Add 'Events' post type
//    $labels = array(
//        'name' => _x('Banner', 'post type general name'),
//        'singular_name' => _x('Banner', 'post type singular name'),
//        'add_new' => _x('Voeg toe', 'location'),
//        'add_new_item' => __('Voeg nieuwe banner toe'),
//        'edit_item' => __('Bewerk banner'),
//        'new_item' => __('Nieuwe banner'),
//        'all_items' => __('Alle banners'),
//        'view_item' => __('Bekijk banner'),
//        'search_items' => __('Zoek banners'),
//        'not_found' => __('Geen banners gevonden'),
//        'not_found_in_trash' => __('Geen banners gevonden in de prullenbak'),
//        'parent_item_colon' => '',
//        'menu_name' => 'Banners'
//    );
//    $args = array(
//        'labels' => $labels,
//        'public' => true,
//        'supports' => array('title', 'editor'),
//        'has_archive' => true
//    );
//    register_post_type('banner', $args);
//}
//
//add_action('init', 'add_custom_post_types');


/** 
 * 
 * @param string $string
 * @param type $amount
 * @return string
 */
function shorten_string($string, $amount) {
    if (strlen($string) > $amount) {
        $string = trim(substr($string, 0, $amount)) . "...";
    }
    return $string;
}

?>