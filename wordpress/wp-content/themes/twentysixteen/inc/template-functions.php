<?php

function display_events_html_function($atts) {

	$atts = shortcode_atts( array(
		'post_per_page' => -1,
		'in_row' => 3,
        'in_row_mobile' => 2
	), $atts, 'display_events_html' );

    $the_query = new WP_Query( array( 'post_type' => 'projekt', 'category_name' => '', 'posts_per_page' => $atts['post_per_page'], 'orderby' => '') );

    $calculate_in_row_css_class = 12 / intval( $atts['in_row'] );
    $calculate_in_row_mobile_css_class = 12 / intval( $atts['in_row_mobile'] );

    if ( $the_query->have_posts() ): ?>

    <?php ob_start(); ?>

    <div class="events-list-container events-list-container-shortcode">

    <?php while ( $the_query->have_posts() ): $the_query->the_post(); ?> 

            <div class="col-xs-<?php echo $calculate_in_row_mobile_css_class ?> col-md-<?php echo $calculate_in_row_css_class ?>">
                <div class="item-profile-thumb item-with-image">
                    <a href="<?php echo get_permalink(); ?>" class="item-link">

                    <?php if (has_post_thumbnail( $post->ID ) ): ?>
                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'item-with-image-project-thumb' ); ?>
                    <?php $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>
                    <p class="item-image">
                        <img src="<?php echo $image[0]; ?>">
                    </p>

                    <?php endif; ?>

                        <div class="item-content-container">

                            <div class="item-thumb-title-container">
                                
                                    <h2 class="item-title"><?php the_title() ?></h2>
                                
                            </div>
                            
                        </div>


                    </a>
                </div>
            </div>
        
        <?php endwhile; ?>
        </div>

        <?php else: ?>
        // no posts found
        <?php endif; ?>

        <?php $output = ob_get_contents(); ?>
        <?php ob_end_clean(); ?>

        <?php return $output; ?>

        <?php /* Restore original Post Data */ wp_reset_postdata();

}

add_shortcode( 'display_events_html', 'display_events_html_function' );


function display_page_actions_social_buttons() {
    
    $current_page = get_current_page_url();
                                              
    echo '<div class="social-icons-share ">';

    echo '<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=' . $current_page . '" class="social-icon social-icon-medium social-icon-facebook-square"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>';
    echo '<a target="_blank" href="https://twitter.com/home?status='. $current_page . '" class="social-icon social-icon-medium social-icon-twitter-square"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>';
    echo '<a href="javascript:window.print()" class="icon icon-print"><i class="fa fa-print" aria-hidden="true"></i></a>';
    //echo '<a href="#" class="icon icon-pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';

    echo '</div>';
    
}

function get_linkedin_link($username) {

    return "https://www.linkedin.com/in/{$username}";

}