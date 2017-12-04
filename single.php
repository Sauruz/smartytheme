<?php

require 'header.php';

assign_content($smarty, $post);

$postsPageId = get_option( 'page_for_posts');
$postsPermalink = get_permalink($postsPageId);
$smarty->assign('blogPermalink', $postsPermalink);

//Create aliasses for translations
$smarty->display('single.tpl');
?>