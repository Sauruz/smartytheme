<?php

//this page is used for blogposts

require 'header.php';


$count_posts = wp_count_posts();
$published_posts = $count_posts->publish;
$published_posts = 45;
$offset = 0;
$posts_per_page = 5;
$pages = ceil($published_posts / 5);

$counter = 1;
$pagingArr = array();
while ($counter <= $pages) {
    $pagingArr[$counter] = array("active" => "");
    $counter++;
}

if (isset($_GET['page'])) {
    $currentPageId = intval($_GET['page']);
} else {
    $currentPageId = 1;
}

if (!isset($pagingArr[$currentPageId])) {
    $currentPageId = 1;
}
$pagingArr[$currentPageId]['active'] = "active";
$offset = ($currentPageId - 1) * $posts_per_page;

$args = array(
    'posts_per_page' => $posts_per_page,
    'offset' => $offset,
    'category' => '',
    'category_name' => '',
    'orderby' => 'date',
    'order' => 'DESC',
    'include' => '',
    'exclude' => '',
    'meta_key' => '',
    'meta_value' => '',
    'post_type' => 'post',
    'post_mime_type' => '',
    'post_parent' => '',
    'author' => '',
    'author_name' => '',
    'post_status' => 'publish',
    'suppress_filters' => true
);
$posts_array = get_posts($args);
foreach ($posts_array as $k => $v) {
    $posts_array[$k]->dutch_post_date = date("d-m-Y", strtotime($v->post_date));
    $posts_array[$k]->dutch_post_time = date("H:i", strtotime($v->post_date));
}

$smarty->assign('posts', $posts_array);
$smarty->assign('paging', $pagingArr);

$postsPageId = get_option( 'page_for_posts' );
$postsPage = get_post($postsPageId);


$page = array(
    "site_name" => get_bloginfo('name'),
    "site_description" => get_bloginfo('description'),
    "permalink" => get_permalink($postsPageId),
    "post_name" => $postsPage->post_name,
    "title" => $postsPage->post_title,
    "content" => "",
    "meta_description" => "Posts overview",
    "meta_title" => $postsPage->post_title . ' - ' . get_bloginfo('name'),
    "featured_image" => false
);

$page["encoded_permalink"] = urlencode($page["permalink"]);
$page["encoded_title"] = urlencode($page["title"]);
$page["encoded_summary"] = urlencode($page["meta_description"]);


$smarty->assign('page', $page);

$smarty->display('posts.tpl');
?>