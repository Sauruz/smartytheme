<?php

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname(__FILE__) . '/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'my_theme_register_required_plugins');

/**
 * Register the required plugins for this theme.
 *
 *  <snip />
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        // This is an example of how to include a plugin bundled with a theme.
        array(
            'name' => 'Advanced custom fields pro', // The plugin name.
            'slug' => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name).
            'source' => get_stylesheet_directory() . '/lib/plugins/advanced-custom-fields-pro.zip', // The plugin source.
            'required' => true, // If false, the plugin is only 'recommended' instead of required.
            'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation' => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => '', // If set, overrides default API URL and points to an external URL.
            'is_callable' => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
        )
    );

    tgmpa($plugins, $config);
}

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

/**
 * 
 * @param type $smarty
 * @param type $post
 */
function assign_content($smarty, $post) {
    //content
    if (have_posts()) : while (have_posts()) : the_post();

            $shortContent = shorten_string(strip_tags($post->post_content), 200);
            $page = array(
                "site_name" => get_bloginfo('name'),
                "site_description" => get_bloginfo('description'),
                "permalink" => get_permalink($post->ID),
                "post_name" => $post->post_name,
                "title" => get_the_title(),
                "content" => apply_filters('the_content', $post->post_content),
                "meta_description" => preg_replace('/\s+/', ' ', $shortContent),
                "meta_title" => get_the_title() . ' - ' . get_bloginfo('name'),
                "featured_image" => false
            );

            if (has_post_thumbnail($post->ID)) {
                $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
                $page["featured_image"] = $image[0];
            }

            $page["encoded_permalink"] = urlencode($page["permalink"]);
            $page["encoded_title"] = urlencode($page["title"]);
            $page["encoded_summary"] = urlencode($page["meta_description"]);

            $smarty->assign('page', $page);
        endwhile;
    endif;
}


?>