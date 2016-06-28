<?php

require 'header.php';

$page = array(
    "site_name" => get_bloginfo('name'),
    "site_description" => get_bloginfo('description'),
    "post_name" => "404",
    "title" => "404",
    "meta_description" => "404",
    "meta_title" => "404"
);

$smarty->assign('page', $page);

$smarty->display('404.tpl');
