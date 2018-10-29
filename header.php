<?php

if (WP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(0);
    ini_set('display_errors', '0');
}

setlocale(LC_ALL, 'nl_NL');



require 'vendor/autoload.php';
define('ROOTPATH', __DIR__);

$smarty = new Smarty;
$smarty->setTemplateDir(ROOTPATH . '/templates');
$smarty->setCompileDir(ROOTPATH . '/templates_c');
$smarty->assign('wp_path', get_template_directory_uri());
$smarty->assign('site_url', site_url());
$smarty->assign('permalink', get_permalink(get_the_ID()));

$menu = wp_get_nav_menu_items('menu');
if ($menu) {
    $menu_ordered = array();
    $c = 0;
    $activeIsSet = false;
    foreach ($menu as $k => $v) {
        $k = $v->ID;
        $menu_ordered[$k] = new stdClass();
        $menu_ordered[$k]->ID = $v->object_id;
        $menu_ordered[$k]->title = $v->title;
        $menu_ordered[$k]->attr_title = $v->attr_title;
        $menu_ordered[$k]->url = $v->url;
        $menu_ordered[$k]->icon = get_field("menu-icon", $v->object_id);
        $menu_ordered[$k]->parent = $v->menu_item_parent;
        $menu_ordered[$k]->subpages = array();

        if (get_the_ID() == $v->object_id) {
            $menu_ordered[$k]->active = "active";
            $activeIsSet = true;
        } else {
            $menu_ordered[$k]->active = "";
        }

        if ($v->menu_item_parent != 0) {
            $menu_ordered[$v->menu_item_parent]->subpages[$k] = $menu_ordered[$k];
            unset($menu_ordered[$k]);
        }
    }
    

    if (!$activeIsSet) {
        $postsId = get_option('page_for_posts');
        foreach ($menu_ordered as $k => $v) {
            if ($postsId === $v->ID) {
                $menu_ordered[$k]->active = "active";
                break;
            }
        }
    }
    
    
    $menu_ordered = array_values($menu_ordered);
    $smarty->assign('menu', $menu_ordered);
} else {
    echo "Create a menu with the title 'menu'";
}
