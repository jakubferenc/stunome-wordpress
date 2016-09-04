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


                <?php
                    the_content();

                    ?>
                       
                    <?php if ( in_array( 9, $this_post_categories ) || in_array( 12, $this_post_categories )): ?>


                    <section class="section post-section post-section-profile">

                        <div class="section-filter">

                            <ul class="nav nav-tabs">

                                <li class="active"><a data-toggle="tab" href="#publikace">Publikace</a></li>
                                <li><a data-toggle="tab" href="#rozvrh">Rozvrh</a></li>
                                <li><a data-toggle="tab" href="#vyucovane-predmety">Vyučované předměty</a></li>

                            </ul>

                        </div>
                        
                        <div class="tab-content">

                            <div id="publikace" class="active tab-pane section-content post-section-content">


                                <?php echo $publikace_content; ?>


                            </div>
                            <div id="rozvrh" class="tab-pane section-content post-section-content">


                                <?php echo $rozvrh_content; ?>

                            </div>
                            <div id="vyucovane-predmety" class="tab-pane section-content post-section-content">


                                <?php echo $vyucovane_predmety_content; ?>


                            </div>

                        </div>



                    </section>

                    <?php endif; ?>



            </div>


            <div class="post-inline-attachment post-aside col-md-4 col-md-offset-1">


                <div class="post-inline-widget">

                    <p><strong><?php echo $full_academic_name ?></strong></p>
                    
                    <?php                  
                        $email = get_post_meta( get_the_ID(), 'email', true );
                        $phone = get_post_meta( get_the_ID(), 'phone', true );
                        $consultation_hours = get_post_meta( get_the_ID(), 'consultation_hours', true );
                        $twitter_username = get_post_meta( get_the_ID(), 'twitter_username', true );
                    ?>
                    
                    
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
                    <p class="email"><strong>Twitter:</strong> <a href="//twitter.com/<?php echo $twitter_username ?>">@<?php echo $twitter_username ?></a></p>    
                    <?php endif; ?>   
                

                </div>

                <?php if (has_post_thumbnail( $post->ID ) ): ?>
                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'item-detail-aside' ); ?>
                    <?php $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>
                            <div class="post-inline-image">
                                <img src="<?php echo $image[0]; ?>">
                            </div>

                <?php endif; ?>



            </div>

        </div>


    </article>