<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

    <?php 

        function filter_array ($item) {
                
            return $item->term_id;

        }

        $this_post_categories = array_map('filter_array', get_the_category( $post->ID ));

        $publikace_content = get_field('publikace');
        $rozvrh_content = get_field('rozvrh');
        $vyucovane_predmety_content = get_field('predmety');

        $full_academic_name = get_full_academic_name($post->ID);

        $twitter_description = get_post_meta( get_the_ID(), 'twitter_description', true );
        $twitter_username = get_post_meta( get_the_ID(), 'twitter_username', true );

        // if post_content exists, display it, otherwise prefer twitter_description
        $real_content = ( ! empty ( get_the_content() ) ) ? get_the_content() : $twitter_description;

        $email = get_post_meta( get_the_ID(), 'email', true );
        $phone = get_post_meta( get_the_ID(), 'phone', true );
        $consultation_hours = get_post_meta( get_the_ID(), 'consultation_hours', true );

        $linkedin_username = get_post_meta( get_the_ID(), 'linkedin_username', true );

        $blog_feed_id = get_post_meta( get_the_ID(), 'blog_feed_id', true );
        $blog_url = get_post_meta( get_the_ID(), 'blog_url', true );
                        
        
    ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="page-content-header-container">

            <div class="page-header">

                <div class="row no-pd">

                    <div class="col-sm-6">
                        <h1 class="page-title"><?php echo $full_academic_name ?></h1>
                    </div>

                    <div class="col-sm-6">

                        <div class="page-header-actions">

                             <?php display_page_actions_social_buttons() ?>

                        </div>


                    </div>

                </div>


            </div>

            <?php wpb_list_child_pages(); ?>

        </div>


        <div class="page-content clearfix row">

            <div class="post-content col-md-7">


               <p> <?php echo $real_content; ?></p>
                       
                    <?php if ( in_array( 9, $this_post_categories ) || in_array( 12, $this_post_categories )): ?>


                    <section class="section post-section post-section-profile">

                        <div class="section-filter">

                            <ul class="nav nav-tabs">

                                <?php if ( ! empty ( $publikace_content ) && $publikace_content !== 'Zatím žádné publikace' ): ?>
                                <li class="active"><a data-toggle="tab" href="#publikace">Publikace</a></li>
                                <?php endif; ?>

                                <?php if ( ! empty ( $rozvrh_content ) ): ?>

                                    <?php if ( empty ( $publikace_content ) or $publikace_content === 'Zatím žádné publikace' ): ?>
                                    <li class="active">
                                    <?php else: ?>
                                    <li>
                                    <?php endif; ?>
                                    <a data-toggle="tab" href="#rozvrh">Rozvrh</a></li>

                                <?php endif; ?>

                                <?php if ( ! empty ( $vyucovane_predmety_content ) ): ?>
                                <li><a data-toggle="tab" href="#vyucovane-predmety">Vyučované předměty</a></li>
                                <?php endif; ?>

                            </ul>

                        </div>
                        
                        <div class="tab-content">

                            <?php if ( ! empty ( $publikace_content ) && $publikace_content !== 'Zatím žádné publikace'): ?>
                            <div id="publikace" class="active tab-pane section-content post-section-content">


                                <?php echo $publikace_content; ?>


                            </div>
                            <?php endif; ?>

                            <?php if ( ! empty ( $rozvrh_content ) ): ?>
                            <div id="rozvrh" class="tab-pane <?php if ( empty ( $publikace_content ) or $publikace_content === 'Zatím žádné publikace' ): ?>active<?php endif; ?> section-content post-section-content">


                                <?php echo $rozvrh_content; ?>

                            </div>
                            <?php endif; ?>

                            <?php if ( ! empty ( $vyucovane_predmety_content ) ): ?>
                            <div id="vyucovane-predmety" class="tab-pane section-content post-section-content">


                                <?php echo $vyucovane_predmety_content; ?>


                            </div>
                            <?php endif; ?>

                        </div>



                    </section>

                    <?php endif; ?>

                    <?php if ( ! empty ( $blog_feed_id ) ): ?>
                        
                        <div class="profile-section profile-section-blogs">

                            <h2 class="section-title"><?php echo __('Blogové příspěvky'); ?></h2>

                            <div class="block section section-blogs section-widget section-blogs-widget">   

                                <?php $the_query = new WP_Query( array( 
                                        'post_type' => 'wprss_feed_item', 
                                        'meta_query' => array(
                                            array(
                                                'key' => 'wprss_feed_id',
                                                'value' => $blog_feed_id ,  
                                                'compare' => '=',
                                            ),
                                        ), 
                                        'posts_per_page' => 6, 
                                        'orderby' => '') ); 
                                    ?>
                                <?php if ( $the_query->have_posts() ): ?>

                                <?php while ( $the_query->have_posts() ) : ?>
                                    <?php $the_query->the_post(); ?>
                                        
                    
                                    
                                    <?php $feed_id = get_post_meta( $post->ID, 'wprss_feed_id', true ); ?>
                                    
                                    <?php $feed_url = get_post_meta( $post->ID, 'wprss_item_permalink', true ); ?>
                                    
                                    <?php $post_feed = get_post( $feed_id ); ?>
                                
                                    <?php $feed_author = $post_feed->post_title; ?>
                                    
                                    <div class="item-event item-event-thumb">
                                        
                                        <a href="<?php echo $feed_url; ?>" class="item-links">
                                            <div class="item-event-header item-event-date"> <?php the_date() ?> / <?php echo $feed_author ?></div>
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
                            
                        </div>        
                    <?php endif; ?>


            </div>


            <div class="post-inline-attachment post-aside col-md-4 col-md-offset-1">


                <div class="post-inline-widget">

                    <p><strong><?php echo $full_academic_name ?></strong></p>
          
                    <?php if ( ! empty(  $email ) ): ?>
                        <p class="email"><strong>E-mail:</strong> <?php echo $email ?></p>    
                    <?php endif; ?>
                    
                    <?php if ( ! empty(  $email ) ): ?>
                        <p class="email"><strong>Telefon:</strong> <?php echo $phone ?></p>    
                    <?php endif; ?>                    
                       
                    <?php if ( ! empty(  $consultation_hours ) ): ?>
                        <p class="email"><strong>Konzultační hodiny:</strong> <?php echo $consultation_hours ?></p>    
                    <?php endif; ?>  

                    <?php if ( ! empty(  $twitter_username ) ): ?>
                    <p class="email twitter"><strong>Twitter:</strong> <a href="//twitter.com/<?php echo $twitter_username ?>">@<?php echo $twitter_username ?></a></p>    
                    <?php endif; ?>   

                    <?php if ( ! empty(  $linkedin_username ) ): ?>
                    <p class="email linkedin"><strong>LinkedIn:</strong> <a href="<?php echo get_linkedin_link($linkedin_username) ?>">@<?php echo $linkedin_username ?></a></p>    
                    <?php endif; ?>                 

                    <?php if ( ! empty(  $blog_url ) ): ?>
                    <p class="email blog"><strong>Blog:</strong> <a href="<?php echo $blog_url ?>"><?php echo $blog_url ?></a></p>    
                    <?php endif; ?> 

                </div>

                <div class="post-inline-image">
                <?php if (has_post_thumbnail( $post->ID ) ): ?>
                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'item-detail-aside' ); ?>
                    <?php $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>
                            
                        <img src="<?php echo $image[0]; ?>">
                            

                <?php else: ?>
                    
                        <img src="<?php echo get_template_directory_uri() ?>/img/profile_picture_default.png">
                    
                <?php endif; ?>
                </div>


            </div>

        </div>


    </article>