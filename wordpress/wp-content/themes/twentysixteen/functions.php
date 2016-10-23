<?php

require_once( get_template_directory() . '/inc/template-functions.php' );

if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	//require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentysixteen_setup' ) ) :

function twentysixteen_setup() {

	load_theme_textdomain( 'twentysixteen', get_template_directory() . '/languages' );


	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );
    
    add_image_size( 'item-with-image-project-thumb', 240, 150, array( 'center', 'center' ) ); // Hard crop center
    add_image_size( 'item-with-image', 240, 240, array( 'center', 'center' ) ); // Hard crop center
    add_image_size( 'item-detail-aside', 400, 400, array( 'center', 'center' ) ); // Hard crop center
	add_image_size( 'sticky-post-thumb', 800, 480, array( 'center', 'center' ) ); // Hard crop center

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

	wp_enqueue_style( 'stunome-fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css', array() );
	wp_enqueue_style( 'stunome-featherlight-css', 'http://cdn.rawgit.com/noelboss/featherlight/1.5.0/release/featherlight.min.css', array() );
	wp_enqueue_style( 'stunome-css', get_template_directory_uri() . '/dist/css/main.min.css', array('stunome-fontawesome') );

	wp_enqueue_script( 'stunome-featherlight', 'https://cdn.rawgit.com/noelboss/featherlight/1.5.0/release/featherlight.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'stunome-js', get_template_directory_uri() . '/dist/js/all.min.js', array('jquery'), null, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20151104' );
	}

	wp_localize_script( 'twentysixteen-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'twentysixteen' ),
		'collapse' => __( 'collapse child menu', 'twentysixteen' ),
	) );

}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );


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




function get_full_academic_name($post_id) {

    $post_person = get_post( $post_id ); 

    $degree_pre = get_post_meta( $post_person->ID, 'degree_pre', 'true' );
    $degree_post = get_post_meta( $post_person->ID, 'degree_post', 'true' );

    $name = $post_person->post_title;

    return $degree_pre . " ". $name . $degree_post;

}


if ( ! function_exists( 'get_current_page_url' ) ) {
    function get_current_page_url() {
      global $wp;
      return add_query_arg( $_SERVER['QUERY_STRING'], '', home_url( $wp->request ) );
    }
}


?>