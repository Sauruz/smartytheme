<?php
/**
 * Template Name: page
*/
require 'header.php';

//content
if (have_posts()) : while (have_posts()) : the_post();

        $bannerimg = get_template_directory_uri() . '/img/banner/building2.JPG';
        $feat_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full-size');
        $oggimage = get_template_directory_uri() . "/img/ogg.png";
        if (!empty($feat_image)) {
           $bannerimg =  $feat_image[0];
           $oggimage = $feat_image[0];
        }
       
        $shortContent = shorten_string(strip_tags($post->post_content), 200);
        $page = array(
            "site_name" => get_bloginfo('name'),
            "site_description" => get_bloginfo('description'),
            "icon" => get_post_meta(get_the_ID(), 'icon_class', true),
            "permalink" => get_permalink($post->ID),
            "post_name" => $post->post_name,
            "title" => get_the_title(),
            "content" => apply_filters('the_content', $post->post_content),
            "meta_description" => preg_replace('/\s+/', ' ', $shortContent),
            "meta_title" => get_the_title() . ' - ' . get_bloginfo('name'),
            "banner_img" => $bannerimg,
            "oggimage" => $oggimage,
        );
        
        $page["encoded_permalink"] = urlencode($page["permalink"]);
        $page["encoded_title"] = urlencode($page["title"]);
        $page["encoded_summary"] = urlencode($page["meta_description"]);

        $smarty->assign('page', $page);
    endwhile;
endif;


//Create aliasses for translations
if (file_exists(get_theme_root() . '/indaad/php/' . $post->post_name . '.php')) {
    include('php/' . $post->post_name . '.php');
}

if (file_exists(get_theme_root() . '/indaad/templates/' . $post->post_name . '.tpl')) {
    $smarty->display($post->post_name . '.tpl');
} else {
    $smarty->display('page.tpl');
}


?>