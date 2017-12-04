<?php
/**
 * Template Name: page
*/
require 'header.php';

assign_content($smarty, $post);

//Create aliasses for translations
if (file_exists(get_theme_root() . '/smartytheme/php/' . $post->post_name . '.php')) {
    include('php/' . $post->post_name . '.php');
}

if (file_exists(get_theme_root() . '/smartytheme/templates/' . $post->post_name . '.tpl')) {
    $smarty->display($post->post_name . '.tpl');
} else {
    $smarty->display('page.tpl');
}

?>