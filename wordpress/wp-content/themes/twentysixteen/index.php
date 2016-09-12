<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>


    <div class="row">

        <div class="col-md-4">

            <section class="block section section-events section-widget block-content-aside">
                
                <h2 class="section-title"><a href="<?php bloginfo('url'); ?>/kalendar-akci">Kalendář akcí</a></h2>
                
                <div class="section-filter">

                    <ul class="nav">

                        <li class="active"><a data-toggle="tab" href="#recommended">Univerzita</a></li>
                        <li><a data-toggle="tab" href="#snm-events">#SNM</a></li>
                        <li><a data-toggle="tab" href="#studium-events">Studium</a></li>

                    </ul>

                </div>

                <div class="tab-content">

                    <div id="recommended" class="tab-content-events tab-pane active">

                         <?php $the_query = new WP_Query( array( 
                                                    'post_type' => 'wprss_feed_item', 
                                                    'meta_query' => array(
                                                        array(
                                                            'key' => 'wprss_feed_id',
                                                            'value' => 11381,  
                                                            'compare' => '=',
                                                        ),
                                                    ), 
                                                    'posts_per_page' => 6, 
                                                    'order' => 'DESC',
                                                    'orderby' => 'date') ); 
                                            ?>
                                <?php 
                                    if ( $the_query->have_posts() ): ?>

                                    <?php while ( $the_query->have_posts() ) : ?>
                                        <?php $the_query->the_post(); ?>
                                          
                                            <?php $feed_id = get_post_meta( $post->ID, 'wprss_feed_id', true ); ?>
                                           
                                            <?php $feed_url = get_post_meta( $post->ID, 'wprss_item_permalink', true ); ?>
    
                                            
                                            <div class="item-event item-event-thumb">
                                                
                                                <a href="<?php echo $feed_url; ?>" class="item-links">
                                                  <div class="hidden item-event-header item-event-date"> </div>
                                                  <div class="item-event-content-container">
                            
                                                    <h3 class="item-event-title"><?php the_title() ?></h3>

                                                    </div>

                                                    
                                                </a>
                                       
                                            </div>
                                            <?php endwhile; ?>

                                        <?php else: ?>
                                            // no posts found
                                        <?php endif; ?>

                                         <?php /* Restore original Post Data */ wp_reset_postdata(); ?>                              
                   
                    </div>
                    <div id="snm-events" class="tab-content-events tab-pane">

                    <?php 

                        $events_snm = json_decode( do_shortcode( '[calendar_get_json id="9895"]' ) );
                    
                        
                    ?>

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

                        <div class="item-event item-event-thumb">
                            
                            <a href="<?php echo $real_link ?>" class="item-links">
                                <div class=" hidden item-event-header item-event-date"></div>
                                <div class="item-event-content-container">
        
                                    <h3 class="item-event-title"><?php echo $event_name; ?> <?php echo $full_date; ?></h3>
                                   
                                    <div class="item-event-content">
                                        <p><?php echo wp_trim_words( $event_description, 20, ' [...]' ); ?></p>
                                    </div>

                                </div>

                                
                            </a>
                    
                        </div>
  
                    <?php endforeach; ?>



                    </div>
                    <div id="studium-events" class="tab-content-events tab-pane">

                    <?php 

                        $events_snm = json_decode( do_shortcode( '[calendar_get_json id="9896"]' ) );
                    
                        
                    ?>

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

                        <div class="item-event item-event-thumb">
                            
                            <a href="<?php echo $real_link ?>" class="item-links">
                                <div class=" hidden item-event-header item-event-date"></div>
                                <div class="item-event-content-container">
        
                                    <h3 class="item-event-title"><?php echo $event_name; ?> <?php echo $full_date; ?></h3>
                                   
                                    <div class="item-event-content">
                                        <p><?php echo wp_trim_words( $event_description, 20, ' [...]' ); ?></p>
                                    </div>

                                </div>

                                
                            </a>
                    
                        </div>
  
                    <?php endforeach; ?>

                    </div>
                </div>


                <div class="section-more"><a href="<?php bloginfo('url'); ?>/kalendar-akci" class="link-section-more">Další akce</a></div>

            </section>

            <section class="block section section-blogs section-widget section-blogs-widget hidden-xs hidden-sm">

                <h2 class="section-title">
                                        <a href="<?php bloginfo('url'); ?>/novinky/nasi-studenti-bloguji/">Naši studenti blogují</a>
                                    </h2>

                <div class="section-content">
                  

                            <?php $the_query = new WP_Query( array( 
                                                    'post_type' => 'wprss_feed_item', 
                                                    'meta_query' => array(
                                                        array(
                                                            'key' => 'wprss_feed_id',
                                                            'value' => 9270,  
                                                            'compare' => 'NOT LIKE',
                                                        ),
                                                    ), 
                                                    'posts_per_page' => 6, 
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
                                            
                                            <div class="item-event item-event-thumb">
                                                
                                                <a href="<?php echo $feed_url; ?>" class="item-links">
                                                              <div class="item-event-header item-event-date"><?php the_date() ?> / <?php echo $feed_author ?></div>
                                                  <div class="item-event-content-container">
                            
                                                    <h3 class="item-event-title"><?php the_title() ?></h3>

                                                    </div>

                                                    
                                                </a>
                                       
                                            </div>
                                            <?php endwhile; ?>

                                                <?php else: ?>
                                                    // no posts found
                                                    <?php endif; ?>

                                                        <?php /* Restore original Post Data */ wp_reset_postdata(); ?>                   
                   
        

                </div>



                <div class="section-more"><a href="<?php bloginfo('url'); ?>/novinky/nasi-studenti-bloguji/" class="link-section-more">Zobrazit další příspěvky</a></div>

            </section>

        </div>

        <div class="col-md-8">

            <section class="block section section-news">

                <div class="item-news slider slider-slick">


                    <?php $the_query = new WP_Query( array( 'category_name' => 'sticky' ) ); ?>
                        <?php 
                                    if ( $the_query->have_posts() ): ?>

                            <?php while ( $the_query->have_posts() ) : ?>
                                <?php $the_query->the_post(); ?>

                                    <a href="<?php echo get_permalink(); ?>" class="item-news-link">

                                        <?php if (has_post_thumbnail( $post->ID ) ): ?>
                                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>
                                                <figure class="item-news-image" style="background-image: url(<?php echo $image[0]; ?>)"></figure>

                                                <?php endif; ?>

                                                    <div class="item-slider-content-container">

                                                        <h3 class="item-news-title"><?php the_title() ?></h3>
                                                        <div class="item-news-meta">
                                                            <p>přidal:
                                                                <?php the_date() ?>
                                                                    <?php the_author() ?>
                                                            </p>
                                                        </div>
                                                        <div class="item-news-content">

                                                            <p>
                                                                <?php the_excerpt() ?>
                                                            </p>

                                                        </div>

                                                    </div>

                                    </a>


                                    <?php endwhile; ?>

                                        <?php else: ?>
                                            // no posts found
                                            <?php endif; ?>

                                                <?php /* Restore original Post Data */ wp_reset_postdata(); ?>


                </div>

                <div class="row">

                    <?php 
                        $cat_id = get_cat_ID('sticky');
                        
                    ?>

                        <?php $the_query = new WP_Query( array( 'category_name' => '', 'category__not_in' => array( $cat_id), 'posts_per_page' => 6 ) ); ?>
                            <?php 
                                    if ( $the_query->have_posts() ): ?>

                                <?php while ( $the_query->have_posts() ) : ?>
                                    <?php $the_query->the_post(); ?>

                                        <div class="item-news item-news-thumb col-xs-6  col-md-4">

                                            <a href="<?php echo get_permalink(); ?>" class="item-news-link">

                                                <?php if (has_post_thumbnail( $post->ID ) ): ?>
                                                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'item-with-image' ); ?>
                                                        <?php $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>
                                                            <figure class="item-news-image" data-url="<?php echo $image_full[0]; ?>"><img src="<?php echo $image[0]; ?>"></figure>

                                                            <?php endif; ?>
                                                                
                                                                
                                                                <div class="item-thumb-title-container">
                                                                    
                                                                    
                                                                <h3 class="item-news-title"><?php the_title() ?></h3>
                                                                <div class="item-news-meta">
                                                                    <p>přidal:
                                                                        <?php the_date() ?>
                                                                            <?php the_author() ?>
                                                                    </p>
                                                                </div>
                                                                    
                                                                </div>

                                                                <div class="item-news-content hidden">

                                                                </div>


                                            </a>
                                        </div>

                                        <?php endwhile; ?>

                                            <?php else: ?>
                                                // no posts found
                                                <?php endif; ?>

                                                    <?php /* Restore original Post Data */ wp_reset_postdata(); ?>


                </div>


                <div class="section-more col-xs-12"><a href="<?php bloginfo('url'); ?>/novinky" class="link-section-more">Další novinky</a></div>

            </section>

        </div>

    </div>


    <section class="section content-block">

        <div class=" block-with-title  block-em block-all-em">

            <div class="row">


                <div class="col-md-4">

                    <div class="col-title"><a href="<?php bloginfo('url'); ?>/o-oboru">O nás</a></div>

                </div>

                <div class="col-md-8">

                    <div class="col-content">
                        <p><strong class="color">Studia nových médií je navazujícím magisterským oborem na FF UK, který se pohybuje na hranici mezi humanitními a vědecky i technicky zaměřenými obory.</strong> Věnuje se jak teorii týkající se vlivu nových technologií na společnost, tak možnostem jejich aplikace. Tomu odpovídá i složení studujících – jsou mezi nimi absolventky a absolventi bakalářských oborů knihovnictví, žurnalistiky, estetiky, marketingové komunikace nebo informačních technologií.
                            <a href="#" class="item-more">
                                <svg class="icon" width="20" height="25">
                                    <use class="icon-arrow" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="./img/icons.svg#arrow"></use>
                                </svg>
                            </a>
                        </p>
                    </div>

                </div>

            </div>


        </div>

    </section>


    <section class="section content-block">

        <div class=" block-with-title ">

            <div class="row">


                <div class="col-md-4">

                    <div class="col-title">

                        <a class="section-title" href="<?php bloginfo('url'); ?>/o-oboru-/profilace">Profilace oboru</a>
                        <p class="section-subtitle">V rámci studia se studující může profilovat ve třech směrech. Jedná se o zaměření Game studies, Digital humanities a Umění, kultura a nová média.</p>

                    </div>

                </div>

                <div class="col-md-8">

                    <div class="col-content">


                        <div class="row">

                            <div class="col-md-4">

                                <div class="item-fullbg-thumb item-with-image item-fullbg-thumb-black">

                                    <a href="<?php bloginfo('url'); ?>/o-oboru-/profilace" class="item-link">


                                        <div class="item-image">
                                            <p>Game studies kriticky analyzují médium počítačových her a zabývají se jejich širšími kulturními, společenskými a politickými aspekty</p>
                                        </div>



                                        <div class="item-content-container">

                                            <h2 class="item-title">Game studies</h2>

                                        </div>

                                    </a>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="item-fullbg-thumb item-with-image item-fullbg-thumb-black">

                                    <a href="<?php bloginfo('url'); ?>/o-oboru-/profilace" class="item-link">


                                        <div class="item-image">
                                            <p>V procesu postupné digitalizace lidského světa a jeho historie se otevírají zcela nové možnosti pro výzkum jak v oblasti humanitních, tak sociálních věd</p>
                                        </div>



                                        <div class="item-content-container">

                                            <h2 class="item-title">Digital Humanities</h2>

                                        </div>

                                    </a>

                                </div>


                            </div>

                            <div class="col-md-4">

                                <div class="item-fullbg-thumb item-with-image item-fullbg-thumb-black">

                                    <a href="<?php bloginfo('url'); ?>/o-oboru-/profilace" class="item-link">


                                        <div class="item-image">
                                            <p>V rámci této větve studující získá komplexní vhled do problematiky vztahu umění, nových médií a technologií a hlavní trendů v uměleckém využití nových technologií</p>
                                        </div>



                                        <div class="item-content-container">

                                            <h2 class="item-title">Umění, kultura a nová média</h2>

                                        </div>

                                    </a>

                                </div>


                            </div>

                        </div>
                    </div>

                </div>

            </div>


        </div>

    </section>


    <section class="section content-block section-profiles section-profiles-thumbs">

        <div class=" block-with-title ">

            <div class="row">


                <div class="col-md-4">

                    <div class="col-title">
                        <a class="section-title" href="<?php bloginfo('url'); ?>/lide">Lidé</a>
                        <p class="section-subtitle">Jinonickou učebnou č. 2067 už prošla řada osobností a zajímavých lidí. Vyučující, studenti, absolventi, doktorandi.</p>
                    </div>

                </div>

                <div class="col-md-8">

                    <div class="col-content">

                        <div class="row">



                            <?php $the_query = new WP_Query( array( 'post_type' => 'osoba', 'category_name' => 'Vyučující', 'posts_per_page' => 9, 'orderby' => 'rand') ); ?>
                                <?php 
                                    if ( $the_query->have_posts() ): ?>

                                    <?php while ( $the_query->have_posts() ) : ?>
                                        <?php $the_query->the_post(); ?>
                                            
                                            <?php $full_academic_name = get_full_academic_name($post->ID); ?>

                                            <div class="col-xs-6 col-md-4">
                                                <div class="item-profile-thumb item-with-image">
                                                    <a href="<?php echo get_permalink(); ?>" class="item-link">

                                                        <?php if (has_post_thumbnail( $post->ID ) ): ?>
                                                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'item-with-image' ); ?>
                                                                <?php $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>
                                                                    <p class="item-image">
                                                                        <img src="<?php echo $image[0]; ?>">
                                                                    </p>

                                                                    <?php endif; ?>

                                                                        <div class="item-content-container">
                                                                            
                                                                            <div class="item-thumb-title-container">
                                                                                
                                                                                 <h2 class="item-title"><?php echo $full_academic_name; ?></h2>
                                                                                
                                                                            </div>
                                                                            
                                                                           

                                                                        </div>


                                                    </a>
                                                </div>
                                            </div>
                                            <?php endwhile; ?>

                                                <?php else: ?>
                                                    // no posts found
                                                    <?php endif; ?>

                                                        <?php /* Restore original Post Data */ wp_reset_postdata(); ?>






                        </div>
                        <div class="row">

                            <div class="section-more col-xs-12"><a href="<?php bloginfo('url'); ?>/lide" class="link-section-more">Další lidé</a></div>

                        </div>


                    </div>

                </div>


            </div>

    </section>

    <section class="section content-block section-profiles block-border section-projects-thumbs">

        <div class=" block-with-title ">

            <div class="row">


                <div class="col-md-4">

                    <div class="col-title">
                        <a class="section-title" href="#">Naše projekty</a>
                        <p class="section-subtitle">Na Studiích nových médií každoročně vznikají projekty, na kterých spolupracují studenti s vyučujícími i naopak. Některé později opouštějí brány školy a fungují samostatně.</p>
                    </div>

                </div>

                <div class="col-md-8">

                    <div class="col-content">

                        <div class="row">



                            <?php $the_query = new WP_Query( array( 'post_type' => 'projekt', 'category_name' => '', 'posts_per_page' => -1, 'orderby' => '') ); ?>
                                <?php 
                                    if ( $the_query->have_posts() ): ?>

                                    <?php while ( $the_query->have_posts() ) : ?>
                                        <?php $the_query->the_post(); ?>

                                            <div class="col-xs-6 col-md-4">
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

                                                <?php else: ?>
                                                    // no posts found
                                                    <?php endif; ?>

                                                        <?php /* Restore original Post Data */ wp_reset_postdata(); ?>


                        </div>

                    </div>

                </div>

            </div>
        </div>


    </section>


    <?php get_footer(); ?>