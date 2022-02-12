<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
//jQuery
// function shapeSpace_include_custom_jquery() {

//   wp_deregister_script('jquery');
//   wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.5.1.js', array(), null, true);
// }
// add_action('wp_enqueue_scripts', 'shapeSpace_include_custom_jquery');

function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
}

//Image Sizes
if (!function_exists('theme_setup')) :
	function theme_setup()
	{
		/* This theme uses post thumbnails (aka "featured images")
	*  all images will be cropped to thumbnail size (below), as well as
	*  a square size (also below). You can add more of your own crop
	*  sizes with add_image_size. */
    add_theme_support('post-thumbnails');
    add_image_size('large-banner', 700, 450, true);
    add_image_size('column', 600, 300,);
    add_image_size('card', 450);
    add_image_size('logo', 90, 125, true);
	}
endif;
add_action('after_setup_theme', 'theme_setup');

//Google Fonts
function google_fonts()
{
	$query_args = array(
		'family' => 'Open+Sans:400,700',
		'subset' => 'latin,latin-ext'
  );
	wp_enqueue_style('google_fonts', add_query_arg($query_args, "//fonts.googleapis.com/css"), array(), null);
}
add_action('wp_enqueue_scripts', 'google_fonts');

function fontawesome() {
  wp_enqueue_script(
    'font-awesome', //handle
    'https://kit.fontawesome.com/6b46070716.js',
    array(), //dependencies
    '6.0.0', // version number
    false //load in footer
  );
  }
  add_action('wp_enqueue_scripts', 'fontawesome');
  
//Add footer widgets
function register_widget_areas() {
    
    register_sidebar( array(
        'name'          => 'RM Sidebar',
        'id'            => 'rm_aside',
        'description'   => 'This widget area description',
        'before_widget' => '<aside class="rm-area rm-area-one">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="footer-heading">',
        'after_title'   => '</h4>',
      ));
    
  register_sidebar( array(
    'name'          => 'Footer area one',
    'id'            => 'footer_area_one',
    'description'   => 'This widget area description',
    'before_widget' => '<section class="footer-area footer-area-one">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4 class="footer-heading">',
    'after_title'   => '</h4>',
  ));

  register_sidebar( array(
    'name'          => 'Footer area two',
    'id'            => 'footer_area_two',
    'description'   => 'This widget area description',
    'before_widget' => '<section class="footer-area footer-area-two">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4 class="footer-heading">',
    'after_title'   => '</h4>',
  ));

  register_sidebar( array(
    'name'          => 'Footer area three',
    'id'            => 'footer_area_three',
    'description'   => 'This widget area description',
    'before_widget' => '<section class="footer-area footer-area-three">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4 class="footer-heading">',
    'after_title'   => '</h4>',
  ));
}
add_action( 'widgets_init', 'register_widget_areas' );

//Add Secondary Menu
register_nav_menus( array(
    'secondary' => __( 'Secondary Menu')
 ) );

//Add categories to pages
function myplugin_settings() {  
  // Add category metabox to page
  register_taxonomy_for_object_type('category', 'page');  
}
// Add to the admin_init hook of your theme functions.php file 
add_action( 'init', 'myplugin_settings' );

//Read More Buttons
add_filter( 'wp_trim_excerpt', 'understrap_all_excerpts_get_more_link' ); 
  
 if ( ! function_exists( 'understrap_all_excerpts_get_more_link' ) ) { 
 	/** 
 	 * Adds a custom read more link to all excerpts, manually or automatically generated 
 	 * 
 	 * @param string $post_excerpt Posts's excerpt. 
 	 * 
 	 * @return string 
 	 */ 
 	function understrap_all_excerpts_get_more_link( $post_excerpt ) { 
 		if ( ! is_admin() ) { 
 			$post_excerpt = $post_excerpt ; 
 		} 
 		return $post_excerpt; 
 	} 
 } 
//Disable comments
function filter_media_comment_status( $open, $post_id ) {
  $post = get_post( $post_id );
  if( $post->post_type == 'attachment' ) {
      return false;
  }
  return $open;
}
add_filter( 'comments_open', 'filter_media_comment_status', 10 , 2 );

//Add redirect filter
add_filter('redirect_canonical','pif_disable_redirect_canonical');

function pif_disable_redirect_canonical($redirect_url) {
    if (is_singular()) $redirect_url = false;
return $redirect_url;
}


//Breadcrumbs
function breadcrumbs()
{
    $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter = '<li class=separator><i class="separator fas fa-chevron-right fa-xs"></i></li>'; // delimiter between crumbs
    $home = 'Home'; // text for the 'Home' link
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $before = '<li class="current" aria-current="page">'; // tag before the current crumb
    $after = '</li>'; // tag after the current crumb

    global $post;
    $homeLink = get_bloginfo('url');
    if (is_home()) {
        if ($showOnHome == 1) {
            echo '<nav aria-label="site breadcrumbs" id="site-breadcrumbs"><ol id="breadcrumbs"><li><a href="' . $homeLink . '">' . $home . '</a></li></ol></nav>';
        }
    } else {
        echo '<nav aria-label="site-breadcrumbs" id="site-breadcrumbs"><ol id="breadcrumbs"><li><a href="' . $homeLink . '">' . $home . '</a></li> ' . $delimiter . ' ';
        if (is_category()) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                echo get_category_parents($thisCat->parent, true, ' ' . $delimiter . ' ');
            }
            echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
        } elseif (is_search()) {
            echo $before . 'Search results for "' . get_search_query() . '"' . $after;
        } elseif (is_day()) {
            echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
            echo '<li><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
            echo $before . get_the_time('d') . $after;
        } elseif (is_month()) {
            echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
            echo $before . get_the_time('F') . $after;
        } elseif (is_year()) {
            echo $before . get_the_time('Y') . $after;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/"></li>' . $post_type->labels->singular_name . '</a>';
                if ($showCurrent == 1) {
                    echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
                }
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                $cats = get_category_parents($cat, true, ' ' . $delimiter . ' ');
                if ($showCurrent == 0) {
                    $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                }
                echo $cats;
                if ($showCurrent == 1) {
                    echo $before . get_the_title() . $after;
                }
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;
        } 
        elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            
            if ($showCurrent == 1) {
                echo  ' ' . $before . get_the_title() . $after;
            }
        } 
        elseif (is_page() && !$post->post_parent) {
            if ($showCurrent == 1) {
                echo $before . get_the_title() . $after;
            }
        } elseif (is_page() && $post->post_parent) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo $breadcrumbs[$i];
                if ($i != count($breadcrumbs)-1) {
                    echo ' ' . $delimiter . ' ';
                }
            }
            if ($showCurrent == 1) {
                echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
            }
        } elseif (is_tag()) {
            echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . 'Articles posted by ' . $userdata->display_name . $after;
        } elseif (is_404()) {
            echo $before . 'Error 404' . $after;
        }
        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                echo ' (';
            }
            echo __('Page') . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                echo ')';
            }
        }
        echo '</ol></nav>';
    }
} // end breadcrumb()


// register_nav_menus( array(
//     'Archives' => 'Archives Navigation',
// ) );

/* Add custom classes to list item "li" */

// function _namespace_menu_item_class( $classes, $item ) {       
//     $classes[] = "list-group-item"; // you can add multiple classes here
//     return $classes;
// } 

// add_filter( 'nav_menu_css_class' , '_namespace_menu_item_class' , 10, 2 );

// //Search to menu bar
// add_filter('wp_nav_menu_items','add_search_box_to_menu', 10, 2);
// function add_search_box_to_menu( $items, $args ) {
//     if( $args->theme_location == 'primary' )
//         return $items."<li class='menu-header-search'><form action='http://example.com/' id='searchform' method='get'><input type='text' name='s' id='s' placeholder='Search'></form></li>";
 
//     return $items;
// }



