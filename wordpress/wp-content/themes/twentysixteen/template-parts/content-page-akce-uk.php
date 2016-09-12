<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

   
        <div class="page-content-header-container">

            <div class="page-header">

                <div class="row no-pd">

                    <div class="col-sm-6">
                        <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
                    </div>

                    <div class="col-sm-6">

                        <div class="page-header-actions">


                                <?php display_page_actions_social_buttons() ?>

                        </div>


                    </div>

                </div>


            </div>


            <div class="page-filter">

                <ul class="nav">
                    <?php
               

                wp_list_pages( array(
                    'title_li' => '',
                    'depth'    => 1,
                    'child_of' => wpdocs_get_post_top_ancestor_id()
                ) );
                ?>
                </ul>

            </div>

        </div>


        <div class="block section section-news ">

            <div class="grid">

                <div class="row ">
                 <?php $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; ?>

                                                <?php $the_query = new WP_Query( array( 
                                                    'post_type' => 'wprss_feed_item', 
                                                    'meta_query' => array(
                                                        array(
                                                            'key' => 'wprss_feed_id',
                                                            'value' => 11381,  
                                                            'compare' => '=',
                                                        ),
                                                    ), 
                                                    'posts_per_page' => 12, 
                                                    'paged' => $paged,
                                                    'order' => 'DESC',
                                                    'orderby' => '') ); 
                                            ?>
                        <?php 
                                    if ( $the_query->have_posts() ): ?>

                            <?php while ( $the_query->have_posts() ) : ?>
                                <?php $the_query->the_post(); ?>



                                    <?php $feed_id = get_post_meta( $post->ID, 'wprss_feed_id', true ); ?>

                                        <?php $feed_url = get_post_meta( $post->ID, 'wprss_item_permalink', true ); ?>

                                            <?php $post_feed = get_post( $feed_id ); ?>

                                                <?php $feed_author = $post_feed->post_title; ?>

                                                    <div class="col-xs-6 col-md-3">

                                                        

                                                            <a href="<?php echo $feed_url; ?>" class="item-news-link item-link">
                                                               
                                                               <div class="item-event item-event-thumb item-bordered">
                                                               
                                                                <div class="item-event-header item-event-date">
                                                                    <?php the_date() ?> /
                                                                        <?php echo $feed_author ?>
                                                                </div>



                                                                    <div class="item-event-content-container">

                                                                        <h3 class="item-event-title"><?php the_title() ?></h3>



                                                                    </div>
                                                                    
                                                                    
                                                                </div>


                                                            </a>

                                                        

                                                    </div>




 
            <?php endwhile; ?>

                <?php else: ?>
                    // no posts found
                    <?php endif; ?>

                        <?php /* Restore original Post Data */ wp_reset_postdata(); ?>



                            </div>

                            </div>

                            <div class="section-more">
                                   
                                <div class="nav-next alignright link-section-more"><?php previous_posts_link( 'Novější akce' ); ?></div>
                                <div class="nav-previous alignleft link-section-more"><?php next_posts_link( 'Starší akce', $the_query->max_num_pages ); ?></div>

                            </div>



        </div>

