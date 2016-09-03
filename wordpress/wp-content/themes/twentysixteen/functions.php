<?php
/**
 * Twenty Sixteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	//require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentysixteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own twentysixteen_setup() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Twenty Sixteen, use a find and replace
	 * to change 'twentysixteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentysixteen', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );
    
    add_image_size( 'item-with-image-project-thumb', 240, 150, array( 'center', 'center' ) ); // Hard crop center
    add_image_size( 'item-with-image', 240, 240, array( 'center', 'center' ) ); // Hard crop center
    add_image_size( 'item-detail-aside', 400, 400, array( 'center', 'center' ) ); // Hard crop center

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'twentysixteen' ),
		'social'  => __( 'Social Links Menu', 'twentysixteen' ),
        'quick-links'  => __( 'Rychlé odkazy', 'twentysixteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	
}
endif; // twentysixteen_setup
add_action( 'after_setup_theme', 'twentysixteen_setup' );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'twentysixteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'twentysixteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'twentysixteen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
//add_action( 'widgets_init', 'twentysixteen_widgets_init' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentysixteen_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_scripts() {

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	//wp_enqueue_style( 'twentysixteen-style', get_stylesheet_uri() );


	wp_enqueue_script( 'twentysixteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151112', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20151104' );
	}

	wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20151204', true );

	wp_localize_script( 'twentysixteen-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'twentysixteen' ),
		'collapse' => __( 'collapse child menu', 'twentysixteen' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function twentysixteen_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'twentysixteen_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function twentysixteen_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}



function wpb_list_child_pages() { 

	global $post; 

	if ( is_page() && $post->post_parent ) {

		$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );

	} else {

		$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );

	}
		

	if ( $childpages ) {

		$string = '<div class="page-filter"><ul class="nav">' . $childpages . '</ul></div>';

		return $string;
	}

}


// Intented to use with locations, like 'primary'
// clean_custom_menu("primary");
 

#add in your theme functions.php file
 
function clean_custom_menu( $theme_location ) {

    if ( ( $theme_location ) && ( $locations = get_nav_menu_locations() ) && isset( $locations[$theme_location] ) ) {

        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $count = 0;
        $main_count = 0;
        $submenu = false;
        $menu_list = "";


        foreach( $menu_items as $menu_item ) {
             
            $link = $menu_item->url;
            $title = $menu_item->title;
            
            $classes_string = implode(" ", $menu_item->classes);
            
            if ( !$menu_item->menu_item_parent ) {

                $parent_id = $menu_item->ID;

                /* 
                    to separate top four and bottom four menu columns
                    we need to add div.row
                */
                if ( $main_count === 0 || $main_count === 4 ) {

                    $menu_list .= '<div class="row">' ."\n"; // div.row

                }

                $menu_list .= '<div class="col-xs-12 col-md-3 col-main-menu">' ."\n";
                $menu_list .= '<div class="main-menu-title">' ."\n";
                $menu_list .= '<p><a href="'.$link.'" class="'.$classes_string.'">'.$title.'</a></p>'."\n";
                $menu_list .= '</div>' ."\n"; // end div.main-menu-title
                
            }
 
            if ( $parent_id == $menu_item->menu_item_parent ) {
 
                if ( !$submenu ) {
                    $submenu = true;
                    $menu_list .= '<ul class="nav menu-submenu hidden-xs hidden-sm">' ."\n";
                }
 
                $menu_list .= '<li class="item">' ."\n";
                $menu_list .= '<a href="'.$link.'" class="'.$classes_string.'">'.$title.'</a>' ."\n";
                $menu_list .= '</li>' ."\n";
                     
                
                if ( array_key_exists( $count + 1, $menu_items  ) ) {

                    if ( $menu_items[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ) {
                        $menu_list .= '</ul>' ."\n";
                        $submenu = false;
                    }

                }

 
            }
            
            if ( array_key_exists( $count + 1, $menu_items  ) ) {

                if ( $menu_items[ $count + 1 ]->menu_item_parent != $parent_id ) { 
                    $menu_list .= '</div>' ."\n";   // end div.col-main-menu   
                    $submenu = false;


                    if ( $main_count === 3 || $main_count === 7 )  {


                    $menu_list .= '</div>' ."\n"; // end of div.row

                    }
                    
                    $main_count++;
                    
                }

            }

            $count++;
 
        }

 
    } else {

        $menu_list = '<!-- no menu defined in location "'.$theme_location.'" -->';

    }
    
    echo $menu_list;
}

function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


if ( ! function_exists( 'wpdocs_get_post_top_ancestor_id' ) ) {
/**
 * Gets the id of the topmost ancestor of the current page.
 *
 * Returns the current page's id if there is no parent.
 * 
 * @return int ID of the top ancestor page.
 */
function wpdocs_get_post_top_ancestor_id() {
    if ( ! $post = get_post() ) {
        return;
    }
     
    $top_ancestor = $post->ID;
    if ( $post->post_parent ) {
        $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
        $top_ancestor = $ancestors[0];
    }
     
    return $top_ancestor;
}
} // Exists.


function display_page_actions_social_buttons() {
    
    $current_page = get_current_page_url();
                                              
    echo '<div class="social-icons-share ">';

    echo '<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=' . $current_page . '" class="social-icon social-icon-medium social-icon-facebook-square"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>';
    echo '<a target="_blank" href="https://twitter.com/home?status='. $current_page . '" class="social-icon social-icon-medium social-icon-twitter-square"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>';
    echo '<a href="javascript:window.print()" class="icon icon-print"><i class="fa fa-print" aria-hidden="true"></i></a>';
    echo '<a href="#" class="icon icon-pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';

    echo '</div>';
    
}

/** 
 Re-use some existing WordPress functions so you don't have to write a bunch of raw PHP to check for SSL, port numbers, etc
 
 Place in your functions.php (or re-use in a plugin)
 If you absolutely don't need or want any query string, use home_url(add_query_arg(array(),$wp->request));
 
 Hat tip to:
  + http://kovshenin.com/2012/current-url-in-wordpress/
  + http://stephenharris.info/how-to-get-the-current-url-in-wordpress/
*/
/**
* Build the entire current page URL (incl query strings) and output it
* Useful for social media plugins and other times you need the full page URL
* Also can be used outside The Loop, unlike the_permalink
* 
* @returns the URL in PHP (so echo it if it must be output in the template)
* Also see the_current_page_url() syntax that echoes it
*/
if ( ! function_exists( 'get_current_page_url' ) ) {
    function get_current_page_url() {
      global $wp;
      return add_query_arg( $_SERVER['QUERY_STRING'], '', home_url( $wp->request ) );
    }
}


?>