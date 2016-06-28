<?php
/**
 * Adjust Advanced Custom Fields Options 
 */

// Page menu title
if( function_exists('acf_set_options_page_menu') )
{
  acf_set_options_page_menu( __('Website opties') );
}

// Page title
if( function_exists('acf_set_options_page_title') )
{
  acf_set_options_page_title( __('Website opties') );
}
 
// Sub page titles
if( function_exists('acf_add_options_sub_page') )
{
  acf_add_options_sub_page( 'Opties A' );
  acf_add_options_sub_page( 'Opties B' );
  acf_add_options_sub_page( 'Opties C' );
}

/**
 * Wordpress improvements & fixes 
 */

// Disable XMLRPC
add_filter( 'xmlrpc_methods', function( $methods ) {
   unset( $methods['pingback.ping'] );
   return $methods;
});

// Wordpress Admin > Disable admin bar
add_filter( 'show_admin_bar', '__return_false' );
//remove_action( 'personal_options', '_admin_bar_preferences' );

// Wordpress Admin > Enable support for post-thumbnails  
add_theme_support('post-thumbnails');

// Wordpress Admin > Enable menus
add_theme_support( 'menus' );

// Remove container around wp_nav_menu
function my_wp_nav_menu_args( $args = '' ) {
	$args['container'] = false;
	return $args;
}
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );

// Wordpress Admin > Remove junk from head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

// Wordpress Admin > Page Slug Body Class
function add_slug_body_class( $classes ) 
{
  global $post;
  if ( isset( $post ) ) {
    $classes[] = $post->post_type . '-' . $post->post_name;
  }
  return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

// Wordpress Admin > Translate pagination url
function my_custom_page_word() {
	global $wp_rewrite;
	$wp_rewrite->pagination_base = 'pagina';
}
add_action( 'init', 'my_custom_page_word' );

// Wordpress Admin > Empty search fix
function my_request_filter( $query_vars ) 
{
  if( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) 
  {
    $query_vars['s'] = " ";
  }
  return $query_vars;
}
add_filter( 'request', 'my_request_filter' );

// Wordpress Admin > Remove menus
function remove_menus () {
global $menu;
	$restricted = array(__('Comments'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
}
add_action('admin_menu', 'remove_menus');

// Wordpress Admin > Custom Excerpt length
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).' ...';
  } else {
    $excerpt = implode(" ",$excerpt).'...';
  } 
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

// Wordpress Admin > Custom Content length
function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  } 
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

// Wordpress Admin > Add Custom Post Type to WP-ADMIN Right Now Widget
// Ref Link: http://wpsnipp.com/index.php/functions-php/include-custom-post-types-in-right-now-admin-dashboard-widget/
// http://wordpress.org/support/topic/dashboard-at-a-glance-custom-post-types
// http://halfelf.org/2012/my-custom-posttypes-live-in-mu/
function vm_right_now_content_table_end() {
    $args = array(
        'public' => true ,
        '_builtin' => false
    );
    $output = 'object';
    $operator = 'and';
    $post_types = get_post_types( $args , $output , $operator );
    foreach( $post_types as $post_type ) {
        $num_posts = wp_count_posts( $post_type->name );
        $num = number_format_i18n( $num_posts->publish );
        $text = _n( $post_type->labels->name, $post_type->labels->name , intval( $num_posts->publish ) );
        if ( current_user_can( 'edit_posts' ) ) {
            $cpt_name = $post_type->name;
        }
        echo '<li class="post-count"><tr><a href="edit.php?post_type='.$cpt_name.'"><td class="first b b-' . $post_type->name . '"></td>' . $num . '&nbsp;<td class="t ' . $post_type->name . '">' . $text . '</td></a></tr></li>';
    }
    $taxonomies = get_taxonomies( $args , $output , $operator );
    foreach( $taxonomies as $taxonomy ) {
        $num_terms  = wp_count_terms( $taxonomy->name );
        $num = number_format_i18n( $num_terms );
        $text = _n( $taxonomy->labels->name, $taxonomy->labels->name , intval( $num_terms ));
        if ( current_user_can( 'manage_categories' ) ) {
            $cpt_tax = $taxonomy->name;
        }
        echo '<li class="post-count"><tr><a href="edit-tags.php?taxonomy='.$cpt_tax.'"><td class="first b b-' . $taxonomy->name . '"></td>' . $num . '&nbsp;<td class="t ' . $taxonomy->name . '">' . $text . '</td></a></tr></li>';
    }
}
add_action( 'dashboard_glance_items' , 'vm_right_now_content_table_end' );

/**
  * Shortcode to include custom elements
  */
function include_element( $atts )
{
  ob_start();
	include('element.'. $atts['type'] .'.php');
	$content = ob_get_clean();
	return $content;
}
add_shortcode( 'element', 'include_element' );

/**
 * All custom functions for this theme are placed in functions.theme.php 
 */
 
// Include theme functions
include_once('functions.theme.php');
?>