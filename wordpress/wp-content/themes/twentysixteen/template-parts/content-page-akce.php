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
         

                    <?php 

                        global $post;

                        $calendar_id = get_post_meta( $post->ID, 'calendar_id', true );

                        if ( ! empty ( $calendar_id ) ) {
                            
                            $events_snm = json_decode( do_shortcode( "[calendar_get_json id='{$calendar_id}']" ) );

                        }

                    ?>

                    <?php if ( ! empty ( $calendar_id ) && ! empty ( $events_snm ) ): ?>

                        <?php foreach ( $events_snm as $event ): ?>

                            <?php

                                $event_name = isset( $event[0]->title ) ? $event[0]->title : '';
                                $event_dtstart = isset( $event[0]->start_utc ) ? $event[0]->start_utc : '';
                                $event_dtend = isset( $event[0]->end_utc ) ? $event[0]->end_utc : '';
                                $event_description = isset( $event[0]->description ) ? nl2br($event[0]->description) : '';
                                $event_location = isset( $event[0]->venue ) ? $event[0]->venue : '';

                                $event_link = isset( $event[0]->link ) ? $event[0]->link : '';

                                $start_time = date('H:i', $event_dtstart );
                                $end_time = date('H:i', $event_dtend );
                                $start_day = date('j. n. Y', $event_dtstart );
                                $end_day = date('j. n. Y', $event_dtend );

                                if ( $start_day === $end_day) {

                                    $full_date = "{$end_day} {$start_time} - {$end_time}";

                                } else {

                                    $full_date = "{$start_day} {$start_time} - {$end_day} {$end_time} ";

                                }
                                
                                preg_match('/(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9-\/]*/', $event_description, $matches_link);

                                $real_link = ( isset( $matches_link[0] ) ) ? $matches_link[0] : $event_link;
                                
                            ?>

                            <div class="col-xs-6 col-md-3">
                                
                                <a href="<?php echo $real_link ?>" class="item-news-link item-link">
                                    <div class="item-event item-event-thumb item-bordered">

                                        <div class="item-event-content-container">
                
                                            <h3 class="item-event-title"><?php echo $event_name; ?> <?php echo $full_date; ?></h3>
                                        
                                            <div class="item-event-content">
                                                <p><?php echo wp_trim_words( $event_description, 20, ' [...]' ); ?></p>
                                            </div>

                                        </div>

                                    </div>


                                    
                                </a>
                        
                            </div>
    
                        <?php endforeach; ?>

                    <?php endif; ?>

                    </div>


                </div>

            </div>



        </div>

