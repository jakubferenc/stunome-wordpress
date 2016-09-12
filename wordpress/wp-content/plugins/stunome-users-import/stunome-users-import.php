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
 * Description:       This is a plugin which imports users as posts of Lidé/osoba type
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

    public $config = array();

 	// Plugin initialization
	public function __construct() {
		// Load up the localization file if we're using WordPress in a different language 
        load_plugin_textdomain( 'stunome_users_import' );  

		add_action( 'admin_menu',                   array( $this, 'add_admin_menu' ) );
		add_action( 'admin_enqueue_scripts',        array( $this, 'admin_enqueues' ) );
		add_action( 'wp_ajax_stunome_import_users_action', array( $this, 'ajax_process_import' ) );
	
		// Allow people to change what capability is required to use this plugin
		$this->capability = apply_filters( 'stunome_users_import_cap', 'manage_options' );

        $this->admin_load_config();
     
    }

	// Register the management page
	public function add_admin_menu() {
        
		$this->menu_id = add_management_page(__( 'Stunome Users Import', 'stunome_users_import' ), __( 'Stunome Import', 'stunome_users_import' ), 'manage_options', $this->capability, array(&$this, 'plugin_interface') 
        );
	}

    protected function admin_load_config() {
        
        require_once plugin_dir_path( __FILE__ ) . 'config/config.php';

        $this->config = $config;

    }

	// Enqueue the needed Javascript and CSS
	public function admin_enqueues( $hook_suffix ) {
		if ( $hook_suffix != $this->menu_id )
			return;

		wp_enqueue_script( 'jquery-ui-progressbar', plugins_url( 'js/jquery.ui.progressbar.min.1.7.2.js', __FILE__ ), array( 'jquery-ui-core' ), '1.7.2' );

        wp_enqueue_script( 'stunome-users-import-main', plugins_url( 'js/stunome-users-import.js', __FILE__ ), array( 'jquery' ), null );

		wp_enqueue_style( 'jquery-ui-regenthumbs', plugins_url( 'js/redmond/jquery-ui-1.7.2.custom.css', __FILE__ ), array(), '1.7.2' );

        wp_enqueue_style( 'stunome-users-import-css', plugins_url( 'css/stunome-users-import.css', __FILE__ ), array(), null );
	}    

    // The user interface of the plugin
    public function plugin_interface() { ?>

        <div class="wrap">

            <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
                

            <?php if ( ! isset( $_FILES["csv-file"] ) ): ?> 

            <div class="plugin-interface__default">

                <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                
                    <!-- remove some meta and generators from the <head> -->
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php __('Choose a file'); ?></span></legend>
                    
                            <input type="file" name="csv-file" />
                            
                                
                    </fieldset>

                    
                    <?php submit_button(__('Importovat'), 'primary','submit', TRUE); ?>

                </form>

            </div>

            <?php else: ?>

            <?php $processed_file = $this->process_file_prepare( $_FILES["csv-file"] ); ?>

            <script>
            
                //window.users_to_import = <?php echo $processed_file['encoded_array'] ?>;

            </script>

            <div class="plugin-interface__after-submit ">
            
                <div id="regenthumbs-bar" style="position:relative; height:25px; background: #ccc; width: 100%">
                    <div id="stunome-bar-percent" style="background: #e4121d; width: 0; height:25px;"></div>
                </div>

                <p>
                    <button style="display:none" type=" button" class="button hide-if-no-js" id="stunome-import-users-btn-stop">
                        <span class="stop-msg"><?php _e( 'Zastavit import') ?></span>
                        <span class="continue-msg hidden"><?php _e( 'Pokračovat v importu') ?></span>
                    </button>
                </p>

                <h3 class="title"><?php _e( 'Debugging Information', 'regenerate-thumbnails' ) ?></h3>

                <p>
                    <?php //printf( __( 'Počet položek k importu: %s'), $processed_file['size'] ); ?><br />
                    <?php //printf( __( 'Počet importovaných položek %s'), '<span id="stunome-debug-successcount">0</span>' ); ?><br />
                    <?php //printf( __( 'Počet chybných importů: %s'), '<span id="stunome-debug-failurecount">0</span>' ); ?>
                </p>

                <div id="stunome-import__debuglist">


                    <?php $this->normal_process_import( $processed_file['processed_array'] ); ?>


                </div>

            </div>  

            <?php endif; ?>      
        
        </div> <!-- end div.wrap -->
       
        <?php


    }

    public function process_file_prepare($file) {

        require_once plugin_dir_path( __FILE__ ) . 'includes/custom-functions.php';


        if ( is_array( $file ) ) {

            $stunome_processed_users_array = csv_to_array($file['tmp_name']);

            $output = array();
            $output['size'] = sizeof($stunome_processed_users_array);
            $output['processed_array'] = $stunome_processed_users_array;
            
            return $output;

        } else {

            throw new Exception('Je třeba vybrat soubor k importu');

        }
        

    }    

    public function _process_file_prepare_json($file) {

        require_once plugin_dir_path( __FILE__ ) . 'includes/twitter-api-php-master/TwitterAPIExchange.php';
        require_once plugin_dir_path( __FILE__ ) . 'includes/custom-functions.php';


        if ( is_array( $file ) ) {

            $stunome_processed_users_array = csv_to_array($file['tmp_name']);

            $output = array();
            $output['size'] = sizeof($stunome_processed_users_array);
            $output['encoded_array'] = json_encode($stunome_processed_users_array);
            
            return $output;

        } else {

            throw new Exception('Je třeba vybrat soubor k importu');

        }
        

    }

    public function get_category_id_by_custom_user_type($user_type) {

        if ( array_key_exists( $user_type, $this->config['wordpress_category_id'] ) ) {

            return $this->config['wordpress_category_id'][$user_type];

        }

        return false;

    }

    // Process import (this is an AJAX handler), return json
    public function _ajax_process_import() {

        require_once plugin_dir_path( __FILE__ ) . 'includes/custom-functions.php';

        $user = json_decode( $_POST['user'] ) ;

        //@error_reporting( 0 ); // Don't break the JSON result

		//header( 'Content-type: application/json' );

        // without the name and active == 1, we will not add an item
        if ( false /*$user['Active'] == "1" && ! empty( $user['Name'] )*/ ) {

            $this_user_twitter_result = new stdClass();
            
            $twitter_profile_image_url = "";
            
            // if there is a twitter username, download info and profile photo
            if ( ! empty ( $user['Username'] ) ) {

                $url = 'https://api.twitter.com/1.1/users/show.json';
                $requestMethod = 'GET';
                $getfield = "?screen_name={$user['Username']}";

                echo "Getting Twitter data for {$user['Username']}:";
                
                $twitter = new TwitterAPIExchange($this->config['twitter']);
                $twitter_response =  $twitter->setGetfield($getfield)
                            ->buildOauth($url, $requestMethod)
                            ->performRequest();   
                
                echo " <strong>OK</strong> <br>";
                
                $this_user_twitter_result = json_decode($twitter_response);

                // remove '_normal' part of the string URL to get the full size
                $twitter_profile_image_url = str_replace('_normal', '', $this_user_twitter_result->profile_image_url);
                $twitter_profile_image_url = str_replace('http://', 'https://', $twitter_profile_image_url);

            }
            
            $build_new_user = array(
            
                'real_name' => $user['Name'],
                'twitter_username' => property_exists( ( object ) $this_user_twitter_result, 'screen_name') ? $this_user_twitter_result->screen_name : "",
                'twitter_description' => property_exists( ( object ) $this_user_twitter_result, 'description') ? $this_user_twitter_result->description : "",
                'twitter_profile_image_url' => isset( $twitter_profile_image_url ) ?: "", 
                'category_id' => $this->get_category_id_by_custom_user_type($user['Class']),
                'blog_url' => $user['Blog'],
                'blog_feed_url' => $user['RSSFeed'],
                'linkedin_username' => $user['LinkedIn'],
                'facebook' => $user['Facebook'],

            );

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

                    $term_taxonomy_ids = wp_set_object_terms( $post_id, $build_new_user['category_id'], 'category', false);
        
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
                
                echo "Updating post meta<br>";

                // update post meta
                update_post_meta($existing_id, 'twitter_username', $build_new_user['twitter_username']);
                update_post_meta($existing_id, 'twitter_description', $build_new_user['twitter_description']);
                update_post_meta($existing_id, 'twitter_profile_image_url', $build_new_user['twitter_profile_image_url']);
                update_post_meta($existing_id, 'blog_url', $build_new_user['blog_url']);
                update_post_meta($existing_id, 'blog_feed_url', $build_new_user['blog_feed_url']);

                update_post_meta($existing_id, 'linkedin_username', $build_new_user['linkedin_username']);
                update_post_meta($existing_id, 'facebook', $build_new_user['facebook']);

                $term_taxonomy_ids = wp_set_object_terms( $existing_id, $build_new_user['category_id'], 'category', false);

                if ( ! is_wp_error( $term_taxonomy_ids ) ) {

                    echo " Updating taxonomy categories: <strong>OK</strong> <br>";

                    echo "Updating profile image to the post: ";

                    upload_attachment_from_url($build_new_user['twitter_profile_image_url'], $existing_id, $build_new_user['twitter_username'] . "-profile-image", true); // the last parameter indicates updating of the profile picture

                    echo " <strong>OK</strong> <br>";
                    
                } else {
                    
                echo "Error in adding the post to categories";
                    
                }

            }

    

        }

        echo $_POST['user'];
       
        die();

    }

    
    public function normal_process_import($stunome_processed_users_array) {

        set_time_limit(0);

        require_once plugin_dir_path( __FILE__ ) . 'includes/twitter-api-php-master/TwitterAPIExchange.php';
        require_once plugin_dir_path( __FILE__ ) . 'includes/custom-functions.php';
  
        foreach ( $stunome_processed_users_array as $user ) {

            // without the name and active == 1, we will not add an item
            if ( $user['Active'] == "1" && ! empty( $user['Name'] ) ) {

                $start = microtime(true);

                echo "<div class='response-box'>";

                echo "Processing {$user['Name']} <br>";

                /* reset twitter data */
                $this_user_twitter_result = new stdClass();
                $twitter_profile_image_url = "";

                // if there is a twitter username, download info and profile photo
                if ( ! empty ( $user['Username'] ) ) {

                    $url = 'https://api.twitter.com/1.1/users/show.json';
                    $requestMethod = 'GET';
                    $getfield = "?screen_name={$user['Username']}";

                    echo "Getting Twitter data for {$user['Username']}:";
                    
                    $twitter = new TwitterAPIExchange($this->config['twitter']);
                    $twitter_response =  $twitter->setGetfield($getfield)
                                ->buildOauth($url, $requestMethod)
                                ->performRequest();   
                            
                    echo " <strong>OK</strong> <br>";
                    
                    
                    $this_user_twitter_result = json_decode($twitter_response);

                    echo "Twitter response:<br><small>" . $twitter_response. "</small><br>";

                    // remove '_normal' part of the string URL to get the full size
                    $twitter_profile_image_url = str_replace('_normal', '', $this_user_twitter_result->profile_image_url);
                    $twitter_profile_image_url = str_replace('http://', 'https://', $twitter_profile_image_url);

                }
                
                $build_new_user = array(
                
                    'real_name' => $user['Name'],
                    'twitter_username' => property_exists( ( object ) $this_user_twitter_result, 'screen_name') ? $this_user_twitter_result->screen_name : "",
                    'twitter_description' => property_exists( ( object ) $this_user_twitter_result, 'description') ? $this_user_twitter_result->description : "",
                    'twitter_profile_image_url' => isset( $twitter_profile_image_url ) ? $twitter_profile_image_url : "", 
                    'category_id' => $this->get_category_id_by_custom_user_type($user['Class']),
                    'blog_url' => $user['Blog'],
                    'blog_feed_url' => $user['RSSFeed'],
                    'linkedin_username' => $user['LinkedIn'],
                    'facebook' => $user['Facebook'],

                );

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

                        $term_taxonomy_ids = wp_set_object_terms( $post_id, $build_new_user['category_id'], 'category', false);
            
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
                    
                    echo "Updating post meta<br>";

                    // update post meta
                    update_post_meta($existing_id, 'twitter_username', $build_new_user['twitter_username']);
                    update_post_meta($existing_id, 'twitter_description', $build_new_user['twitter_description']);
                    update_post_meta($existing_id, 'twitter_profile_image_url', $build_new_user['twitter_profile_image_url']);
                    update_post_meta($existing_id, 'blog_url', $build_new_user['blog_url']);
                    update_post_meta($existing_id, 'blog_feed_url', $build_new_user['blog_feed_url']);

                    update_post_meta($existing_id, 'linkedin_username', $build_new_user['linkedin_username']);
                    update_post_meta($existing_id, 'facebook', $build_new_user['facebook']);

                    $term_taxonomy_ids = wp_set_object_terms( $existing_id, $build_new_user['category_id'], 'category', false);

                    if ( ! is_wp_error( $term_taxonomy_ids ) ) {
                        
                        echo " Updating taxonomy categories: <strong>OK</strong> <br>";

                                                    
                        if ( ! empty ( $build_new_user['twitter_profile_image_url'] ) ) {

                            echo "Removing previous profile image of the post: ";

                            $post_thumbnail_id = get_post_thumbnail_id( $existing_id );

                            if ( false === wp_delete_attachment( $post_thumbnail_id, true ) ) {

                                echo "Error <br>";

                            } else {

                                echo "<strong>OK</strong> <br>";

                            }

                            echo "Updating profile image to the post: ";


                            try {

                                upload_attachment_from_url($build_new_user['twitter_profile_image_url'], $existing_id, $build_new_user['twitter_username'] . "-profile-image", true); // the last parameter indicates updating of the profile picture
                            
                            } catch (Exception $e) {

                                echo 'Caught exception: ',  $e->getMessage(), "\n";
                            }

                            echo " <strong>OK</strong> <br>";

                        }

                        
                    } else {
                        
                    echo "Error in adding the post to categories";
                        
                    }

                    // updating blog feed

                    if ( ! empty ( $build_new_user['blog_feed_url'] ) ) {   

                        echo "Updating Blog Feed URL: ";

                        $existing_blog_feed_id = custom_post_exists_by_title ( $build_new_user['real_name'], 'wprss_feed' );

                        if ( ! $existing_blog_feed_id && ! is_wp_error( $existing_blog_feed_id )) {

                            // user existed before, but did not have a blog feed added

                            $post_blog_feed_id = wp_insert_post(array (
                                'post_type' => 'wprss_feed',
                                'post_title' => $build_new_user['real_name'],
                                'post_content' => '',
                                'post_status' => 'publish',
                                'comment_status' => 'closed',   // if you prefer
                                'ping_status' => 'closed',      // if you prefer
                            )); 

                            echo " <strong>OK</strong> <br>";
                            
                            echo "Adding meta data to the blog feed post: ";
                            
                            // insert post meta

                            add_post_meta($post_blog_feed_id, 'wprss_url', $build_new_user['blog_feed_url']); 
                            add_post_meta($post_blog_feed_id, 'wprss_force_feed', 'true');  

                            echo " <strong>OK</strong> <br>";     

                            // adding blog_feed_id to the profile meta for future referencing (which is faster by id than name) 
                            echo "Adding blog feed ID to profile meta data: ";

                            add_post_meta($existing_id, 'blog_feed_id', $post_blog_feed_id);

                            echo " <strong>OK</strong> <br>";                               

                        } else {

                            $existing_blog_feed_id = custom_post_exists_by_title ( $build_new_user['real_name'], 'wprss_feed' );

                            if ( ! $existing_blog_feed_id && ! is_wp_error( $existing_blog_feed_id )) {

                                 // user has had a blog, but now there appears to be no url, so we delete the old blog

                                 echo "user has had a blog, but now there appears to be no url, so we delete the old blog";

                                 wp_delete_post( $existing_blog_feed_id, true );

                                 echo " <strong>OK</strong> <br>";          

                            }

                            // user has an existing feed, let's update the url'
                            update_post_meta($existing_blog_feed_id, 'wprss_url', $build_new_user['blog_feed_url']); 

                        }

                    }


                }

                $time_elapsed_secs = microtime(true) - $start;
                
                echo "<br>Přidáno za " . number_format($time_elapsed_secs, 3) . " vteřin";

                echo "</div>";

            }

        }
  
    }


}

// Start up this plugin
add_action( 'init', 'StunomeUsersImportRun' );
function StunomeUsersImportRun() {
	global $StunomeUsersImport;
	$StunomeUsersImport = new StunomeUsersImport();
}


