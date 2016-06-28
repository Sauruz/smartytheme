<?php
/**
 * Template Name: page
*/
require 'header.php';

//content
if (have_posts()) : while (have_posts()) : the_post();

        $img = "";
        $feat_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full-size');
        $oggimage = get_template_directory_uri() . "/img/ogg.png";
        if (!empty($feat_image)) {
           $img =  $feat_image[0];
           $oggimage = $feat_image[0];
        }
        
       
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
            "image" => $img,
            "oggimage" => $oggimage
        );

        $page["encoded_permalink"] = urlencode($page["permalink"]);
        $page["encoded_title"] = urlencode($page["title"]);
        $page["encoded_summary"] = urlencode($page["meta_description"]);

        $smarty->assign('page', $page);
    endwhile;
endif;

//print_r($page);

$smarty->display('nieuws-detail.tpl');


?>