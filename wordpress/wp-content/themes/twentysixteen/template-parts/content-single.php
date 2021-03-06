<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>



    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

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

            <?php wpb_list_child_pages(); ?>

        </div>


        <div class="page-content clearfix row">

            <div class="post-content col-md-7">


                <?php
                    the_content();

                    ?>

                    <?php
                        $show_image_in_content = get_post_meta( get_the_ID(), 'show_image_in_content', true );
                    ?>


                    <?php if ( ! empty(  $show_image_in_content ) &&  $show_image_in_content == 1): ?>

                        <?php if (has_post_thumbnail( $post->ID ) ): ?>
                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>
                            <?php $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>
                            <div class="post-detail-image">
                                <img src="<?php echo $image[0]; ?>">
                            </div>

                        <?php endif; ?>



                    <?php endif; ?>


            </div>

            <div class="post-inline-attachment post-aside col-md-4 col-md-offset-1">


                <div class="post-inline-widget">

                    <p><strong>přidal</strong>: <a href="#"><?php the_author() ?></a></p>
                    <p><strong>dne</strong>: <?php the_date() ?> </p>

                </div>



                <?php if (has_post_thumbnail( $post->ID ) ): ?>
                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>
                    <?php $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>
                    <div class="post-inline-image">


                        <a href="#" data-featherlight="<?php echo $image_full[0] ?>"><img width="100%" src="<?php echo $image[0]; ?>"></a><a href="#" data-featherlight="<?php echo $image_full[0] ?>" class="link-more"><?php _e('Zvětšit obrázek'); ?></a>

                    </div>

                <?php endif; ?>


            </div>



        </div>


        <section class="section content-block block-with-title block-border">

                        <div class="col-title">
                            <h3 class="section-title">Dále si přečtěte</h3>

                        </div>

                        <div class="col-content">


                            <div class="row ">

                                 <?php
                        $cat_id = get_cat_ID('sticky');

                    ?>

                        <?php $the_query = new WP_Query( array( 'category_name' => '', 'post__not_in'=> array($post->ID), 'category__not_in' => array( $cat_id), 'posts_per_page' => 4 ) ); ?>
                            <?php
                                    if ( $the_query->have_posts() ): ?>

                                <?php while ( $the_query->have_posts() ) : ?>
                                    <?php $the_query->the_post(); ?>

                                        <div class="item-news item-news-thumb col-sm-6 col-md-3">

                                            <a href="<?php echo get_permalink(); ?>" class="item-news-link">

                                                <?php if (has_post_thumbnail( $post->ID ) ): ?>
                                                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'item-with-image' ); ?>
                                                        <?php $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>
                                                            <figure class="item-news-image" data-url="<?php echo $image_full[0]; ?>"><img src="<?php echo $image[0]; ?>"></figure>

                                                            <?php endif; ?>



                                                                <h2 class="item-news-title"><?php the_title() ?></h2>
                                                                <div class="item-news-meta">
                                                                    <p>přidal:
                                                                        <?php the_date() ?>
                                                                            <?php the_author() ?>
                                                                    </p>
                                                                </div>



                                            </a>
                                        </div>

                                        <?php endwhile; ?>

                                            <?php else: ?>
                                                // no posts found
                                                <?php endif; ?>

                                                    <?php /* Restore original Post Data */ wp_reset_postdata(); ?>


                            </div>


                            <div class="section-more"><a href="<?php bloginfo('url'); ?>/novinky" class="link-section-more">Další novinky</a></div>

                        </div>

                    </section>

                    <section class="section content-block block-with-title projects-after-single">

                        <div class="col-title">
                            <h3 class="section-title"><a href="<?php bloginfo('url'); ?>/nase-projekty">Naše projekty</a></h3>

                        </div>

                        <div class="col-content">


                            <div class="item-project">
                                <a href="/projekt/ceskoslovensko-38-89/"><img src="/wordpress/wp-content/uploads/2016/10/ceskoslovensko_3889_animace.gif"></a>
                            </div>


                        </div>

                    </section>

    </article>
