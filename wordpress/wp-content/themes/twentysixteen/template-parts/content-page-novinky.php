<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

    <article class="">

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


        <section class="block section section-news ">

            <div class="grid">

                <div class="row ">

                    <?php 
                        $cat_id = get_cat_ID('sticky');
                        
                    ?>

                        <?php $the_query = new WP_Query( array( 'category_name' => '', 'category__not_in' => array( $cat_id), 'posts_per_page' => 12 ) ); ?>
                            <?php 
                                    if ( $the_query->have_posts() ): ?>

                                <?php while ( $the_query->have_posts() ) : ?>
                                    <?php $the_query->the_post(); ?>

                                        <div class="item-news item-news-thumb col-xs-6 col-md-3">

                                            <a href="<?php echo get_permalink(); ?>" class="item-news-link">

                                                <?php if (has_post_thumbnail( $post->ID ) ): ?>
                                                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'item-with-image' ); ?>
                                                        <?php $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>
                                                            <figure class="item-news-image" data-url="<?php echo $image_full[0]; ?>"><img src="<?php echo $image[0]; ?>"></figure>

                                                            <?php endif; ?>
                                                              <div class="item-thumb-title-container">
                                                                                
                                                                                  <h2 class="item-news-title"><?php the_title() ?></h2>
                                                                <div class="item-news-meta">
                                                                    <p>přidal:
                                                                        <?php the_date() ?>
                                                                            <?php the_author() ?>
                                                                    </p>
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

            <div class="section-more"><a href="#" class="link-section-more">Další novinky</a></div>



        </section>


    </article>