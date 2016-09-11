<?php


function custom_post_exists_by_title($title, $post_type) {


    global $wpdb;


    $query = "
            SELECT      ID
            FROM        $wpdb->posts
            WHERE       $wpdb->posts.post_title LIKE '$title'
            AND         $wpdb->posts.post_type = '$post_type'
            AND         $wpdb->posts.post_status = 'publish'
            ORDER BY    $wpdb->posts.post_title
    ";
    
    $result = $wpdb->get_results($query);

    return ( is_array($result) && array_key_exists( 0, $result ) ) ? $result[0]->ID : 0;
          
}

function csv_to_array($filename='', $delimiter=';')
{
	if(!file_exists($filename) || !is_readable($filename))
		return FALSE;
	
	$header = NULL;
	$data = array();
	if (($handle = fopen($filename, 'r')) !== FALSE)
	{
		while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
		{
			if(!$header)
				$header = $row;
			else
				$data[] = array_combine($header, $row);
		}
		fclose($handle);
	}
	return $data;
}



function upload_attachment_from_url($url, $post_id, $desc, $update = false) {

    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    require_once(ABSPATH . "wp-admin" . '/includes/media.php');

    if ( ! empty( $url ) ) {

        $file_array = array();

        // Download file to temp location
        $tmp = download_url( $url);

         if ( is_wp_error( $tmp ) ) {

            // If error storing temporarily, unlink
            @unlink($file_array['tmp_name']);
            $file_array['tmp_name'] = '';

         } else {

            // Set variables for storage
            // fix file filename for query strings
            preg_match('/[^\?]+\.(jpg|JPG|jpe|JPE|jpeg|JPEG|gif|GIF|png|PNG)/', $url, $matches);
            $file_array['name'] = basename($matches[0]);
            $file_array['tmp_name'] = $tmp;

         }

        // do the validation and storage stuff
        $id = media_handle_sideload( $file_array, $post_id, $desc );
  
        // If error storing permanently, unlink
        if ( is_wp_error($id) ) {

            throw new Exception( $id->get_error_messages() );

            @unlink($file_array['tmp_name']);

        } else {

            // if uploaded add the id of media to post_meta

            if ( $update === false ) {

                add_post_meta($post_id, '_thumbnail_id', $id, true);


            } else {

                update_post_meta($post_id, '_thumbnail_id', $id);

            }

        }

    }

}
