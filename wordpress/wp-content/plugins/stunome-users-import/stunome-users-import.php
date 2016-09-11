<?php

/**

**************************************************************************

 * @link              http://www.jakubferenc.cz
 * @since             1.0.0
 * @package           Stunome_Users_Import
 *
 * @wordpress-plugin
 * Plugin Name:       Stunome Users Import
 * Plugin URI:        http://www.jakubferenc.cz
 * Description:       This is a plugin which imports usernames as posts of Lidé/osoba type
 * Version:           1.0.0
 * Author:            Jakub Ferenc
 * Author URI:        http://www.jakubferenc.cz
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       stunome_users_import
 * Domain Path:       /languages

**************************************************************************

 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


class StunomeUsersImport {

    public $menu_id;

    public $capability;

 	// Plugin initialization
	public function __construct() {
		// Load up the localization file if we're using WordPress in a different language 
        load_plugin_textdomain( 'stunome_users_import' );  

		add_action( 'admin_menu',                   array( &$this, 'add_admin_menu' ) );
        add_action( 'admin_enqueue_libraries',      array( &$this, 'admin_enqueue_libraries' ) );
		add_action( 'admin_enqueue_scripts',        array( &$this, 'admin_enqueue_scripts' ) );
		add_action( 'wp_ajax_stunome_import_users', array( &$this, 'ajax_process_import' ) );
	
		// Allow people to change what capability is required to use this plugin
		$this->capability = apply_filters( 'stunome_users_import_cap', 'manage_options' );
     
    }

	// Register the management page
	public function add_admin_menu() {
        
		$this->menu_id = add_management_page(__( 'Stunome Users Import', 'stunome_users_import' ), __( 'Stunome Import', 'stunome_users_import' ), 'manage_options', $this->capability, array(&$this, 'plugin_interface') 
        );
	}

    public function admin_enqueue_libraries() {

        require_once plugin_dir_path( __FILE__ ) . 'includes/twitter-api-php-master/TwitterAPIExchange.php';
        require_once plugin_dir_path( __FILE__ ) . 'includes/custom-functions.php';

    }

	// Enqueue the needed Javascript and CSS
	public function admin_enqueues( $hook_suffix ) {
		if ( $hook_suffix != $this->menu_id )
			return;

		wp_enqueue_script( 'jquery-ui-progressbar', plugins_url( 'jquery-ui/jquery.ui.progressbar.min.1.7.2.js', __FILE__ ), array( 'jquery-ui-core' ), '1.7.2' );

		wp_enqueue_style( 'jquery-ui-regenthumbs', plugins_url( 'jquery-ui/redmond/jquery-ui-1.7.2.custom.css', __FILE__ ), array(), '1.7.2' );
	}    

    // The user interface of the plugin
    public function plugin_interface() { ?>

        <div class="wrap">

            <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
            
            <form name="<?php echo $this->plugin_name; ?>-form" action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            
                <!-- remove some meta and generators from the <head> -->
                <fieldset>
                    <legend class="screen-reader-text"><span>Choose a CSV file</span></legend>
                
                        <input type="file" id="<?php echo $this->plugin_name; ?>-file-id" name="csv-file" />
                        
                            
                </fieldset>

                <?php submit_button('Import Twitter users', 'primary','submit', TRUE); ?>

            </form>

        </div>
        
        <?php
        /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
        $settings = array(
            'oauth_access_token' => "3166867588-Pmjt1WGMEq6OflE2lrA9YJzV654hINDq88oyP72",
            'oauth_access_token_secret' => "QkvS5JpS8CJdVQFzFyKoadpxtr1lJvM05iBlx1cIAtsSt",
            'consumer_key' => "6ncJvcMqz9VVsTdnrYZvLrsFc",
            'consumer_secret' => "13ThmhdEmlAkSP6lLLrUHjkaLjWzUSsGd0IB93nnAJxvOPB4AR"
        );


        if ( isset( $_FILES["csv-file"]) ) {
            
            $stunome_twitter_users_array = csv_to_array($_FILES["csv-file"]['tmp_name']);   

            foreach ($stunome_twitter_users_array as $user) {

                set_time_limit(5);

                // without the name and active == 1, we will not add an item
                if ( $user['Active'] == "1" && ! empty( $user['Name'] ) ) {

                    $this_user = new stdClass();
                    
                    $twitter_profile_image_url = "";
                    
                    // if there is a twitter username, download info and profile photo
                    if ( ! empty ( $user['Username'] ) ) {

                        $url = 'https://api.twitter.com/1.1/users/show.json';
                        $requestMethod = 'GET';
                        $getfield = "?screen_name={$user['Username']}";

                        echo "Getting Twitter data for {$user['Username']}:";
                        
                        $twitter = new TwitterAPIExchange($settings);
                        $twitter_response =  $twitter->setGetfield($getfield)
                                    ->buildOauth($url, $requestMethod)
                                    ->performRequest();   
                        
                        echo " <strong>OK</strong> <br>";
                        
                        $this_user = json_decode($twitter_response);

                        // remove '_normal' part of the string URL to get the full size
                        $twitter_profile_image_url = str_replace('_normal', '', $this_user->profile_image_url);
                        $twitter_profile_image_url = str_replace('http://', 'https://', $twitter_profile_image_url);

                    }
                    
                    $build_new_user = array(
                    
                        'real_name' => $user['Name'],
                        'twitter_username' => property_exists( ( object ) $this_user, 'screen_name') ? $this_user->screen_name : "",
                        'twitter_description' => property_exists( ( object ) $this_user, 'description') ? $this_user->description : "",
                        'twitter_profile_image_url' => isset( $twitter_profile_image_url ) ?: "", 
                        'type' => $user['Class'], // get type of the user: 1 student first year, 2 student second and later years, friend
                        'blog_url' => $user['Blog'],
                        'blog_feed_url' => $user['RSSFeed'],
                        'linkedin_username' => $user['LinkedIn'],
                        'facebook' => $user['Facebook'],

                    );

                    /*
                        category for teacher is not needed, because those profiles
                        are added manually

                        the category IDs are arbitrarily set based on the current database of categories in wordpress

                    */                
                    if (  $build_new_user['type'] == 1) {
                        
                        $cat_ids = 7;
                        
                    } else if (  $build_new_user['type'] == 2 ) {
                        
                        $cat_ids = 8;
                        
                    } else if (  $build_new_user['type'] == 'friend' ) {
                        
                        $cat_ids = 16;
                        
                    }  

                    // if the person exists, get the id
                    $existing_id = custom_post_exists_by_title ( $build_new_user['real_name'], 'osoba' );

                    if ( ! $existing_id ) {
                        
                        echo "Post doesn't exist yet, creating a new one";
                        
                        // if no user by title or content exists, create/import a new one
                        // no need to check if the user is a teacher who might have already a custom description, not from the twitter account

                        $post_id = wp_insert_post(array (
                            'post_type' => 'osoba',
                            'post_title' => $build_new_user['real_name'],
                            'post_content' => '',
                            'post_status' => 'publish',
                            'comment_status' => 'closed',   // if you prefer
                            'ping_status' => 'closed',      // if you prefer
                        ));            
                        
                        
                                if ( $post_id ) {
                                    
                                    echo " <strong>OK</strong> <br>";
                                    
                                    echo "Adding meta data to the post: ";
                                    
                                    // insert post meta
                                    add_post_meta($post_id, 'twitter_username', $build_new_user['twitter_username']);
                                    add_post_meta($post_id, 'twitter_description', $build_new_user['twitter_description']);
                                    add_post_meta($post_id, 'twitter_profile_image_url', $build_new_user['twitter_profile_image_url']);
                                    add_post_meta($post_id, 'blog_url', $build_new_user['blog_url']);
                                    add_post_meta($post_id, 'blog_feed_url', $build_new_user['blog_feed_url']);

                                    add_post_meta($post_id, 'linkedin_username', $build_new_user['linkedin_username']);
                                    add_post_meta($post_id, 'facebook', $build_new_user['facebook']);

                                    $term_taxonomy_ids = wp_set_object_terms( $post_id, $cat_ids, 'category', true);
                        
                                    if ( ! is_wp_error( $term_taxonomy_ids ) ) {

                                        echo " <strong>OK</strong> <br>";

                                        // if we received twitter profile info and profile image url
                                        if ( ! empty ( $build_new_user['twitter_profile_image_url'] ) ) {

                                            echo "Adding profile image to the post: ";

                                            try {

                                                upload_attachment_from_url($build_new_user['twitter_profile_image_url'], $post_id, $build_new_user['twitter_username'] . "-profile-image");
                                            
                                            } catch (Exception $e) {

                                                echo 'Caught exception: ',  $e->getMessage(), "\n";
                                            }

                                            echo " <strong>OK</strong> <br>";
                                        
                                        }

                                    } else {
                                        
                                        echo "Error in adding the post to categories";
                                        
                                    }

                                    // adding blog feed

                                    if ( ! empty ( $build_new_user['blog_feed_url'] ) ) {

                                        echo "Adding Blog Feed URL: ";

                                        $post_blog_feed_id = wp_insert_post(array (
                                            'post_type' => 'wprss_feed',
                                            'post_title' => $build_new_user['real_name'],
                                            'post_content' => '',
                                            'post_status' => 'publish',
                                            'comment_status' => 'closed',   // if you prefer
                                            'ping_status' => 'closed',      // if you prefer
                                        )); 

                                        if ($post_blog_feed_id) {
                                            
                                            echo " <strong>OK</strong> <br>";
                                            
                                            echo "Adding meta data to the blog feed post: ";
                                            
                                            // insert post meta

                                            add_post_meta($post_blog_feed_id, 'wprss_url', $build_new_user['blog_feed_url']); 
                                            add_post_meta($post_blog_feed_id, 'wprss_force_feed', 'true');  

                                            echo " <strong>OK</strong> <br>";     

                                            // adding blog_feed_id to the profile meta for future referencing (which is faster by id than name) 
                                            echo "Adding blog feed ID to profile meta data: ";

                                            add_post_meta($post_id, 'blog_feed_id', $post_blog_feed_id);

                                            echo " <strong>OK</strong> <br>";     
        
                                        } else {

                                            echo "Error";

                                        }


                                }

                            }                           
            
                        
                    } else {
                        
                        echo "Post for the user {$build_new_user['real_name']} already exist yet, will update it only<br>";
                        
                        echo "Updating post content: ";
                    
                    /*

                        Will not update content, because for content the twitter desc is used,
                        or the content must be manually added/edited in administration.

                        The reason being that if a student wants different content than on their twitter,
                        it can be manually edited through administration. 

                        $attrs = array(
                            'ID'           => $existing_id,
                            'post_content' => '',
                        );

                        // Update the post into the database
                        $updated_post_id = wp_update_post( $attrs, true);

                        if ( is_wp_error($updated_post_id) ) {

                            $errors = $updated_post_id->get_error_messages();
                            
                            foreach ($errors as $error) {
                                echo $error . ", ";
                            }

                            echo "Error in updating the content of the post<br>";

                        } else {

                            echo "OK <br>";

                        }*/

                        echo "Updating post meta<br>";

                        // update post meta
                        update_post_meta($existing_id, 'twitter_username', $build_new_user['twitter_username']);
                        update_post_meta($existing_id, 'twitter_description', $build_new_user['twitter_description']);
                        update_post_meta($existing_id, 'twitter_profile_image_url', $build_new_user['twitter_profile_image_url']);
                        update_post_meta($existing_id, 'blog_url', $build_new_user['blog_url']);
                        update_post_meta($existing_id, 'blog_feed_url', $build_new_user['blog_feed_url']);

                        update_post_meta($existing_id, 'linkedin_username', $build_new_user['linkedin_username']);
                        update_post_meta($existing_id, 'facebook', $build_new_user['facebook']);

                        $term_taxonomy_ids = wp_set_object_terms( $existing_id, $cat_ids, 'category', true);

                        if ( ! is_wp_error( $term_taxonomy_ids ) ) {

                            echo " Updating taxonomy categories: <strong>OK</strong> <br>";

                            echo "Updating profile image to the post: ";

                            upload_attachment_from_url($build_new_user['twitter_profile_image_url'], $existing_id, $build_new_user['twitter_username'] . "-profile-image", true); // the last parameter indicates updating of the profile picture

                            echo " <strong>OK</strong> <br>";
                            
                        } else {
                            
                        echo "Error in adding the post to categories";
                            
                        }

                    }

                } else {

                    echo "The item does not have an username or Name. Will not import the item.";

                }


            }    

            
        } 

    }

    // Process import (this is an AJAX handler), return json
    public function ajax_process_import() {

        @error_reporting( 0 ); // Don't break the JSON result

		header( 'Content-type: application/json' );

    }

}


