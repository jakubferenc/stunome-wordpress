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


        <div class="page-content clearfix">



            <?php $meta_year = get_post_meta($post->ID, 'project_metadata_year', true); ?>


            <?php if ( !empty($meta_year) ): ?>

            <div class=" row post-header-meta-info">
                <ul class="nav col-xs-12">
                    <?php if(!empty($meta_year)): ?><li><strong>Rok dokončení</strong>: <?php echo $meta_year ?></li><?php endif ?>
                </ul>
            </div>

            <?php endif; ?>

            <div class="row">
                <div class="post-content col-xs-12">


                    <?php
                        the_content();

                        ?>
                </div>
            </div>


                <div class="post-meta-container">



                <div class="row post-meta-more-info">

                    <h2 class=" col-xs-12">Chceš zjistit více o projektu?</h2>

                    <?php if (has_post_thumbnail( $post->ID ) ): ?>
                    <div class=" col-xs-12 col-md-4 post-inline-image">
                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>
                        <?php $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>
                        <img  src="<?php echo $image[0]; ?>">
                    </div>
                    <?php endif; ?>

                    <?php $meta_main_url = get_post_meta($post->ID, 'project_metadata_main_url', true); ?>
                    <?php $meta_app_download = get_post_meta($post->ID, 'project_metadata_app_download', true); ?>
                    <?php $meta_catch_phrase = get_post_meta($post->ID, 'project_catch_phrase', true); ?>

                    <?php if(!empty($meta_catch_phrase)): ?>
                    <div class="col-xs-12 col-md-6 post-meta-catch-phrase">
                        <p><?php echo $meta_catch_phrase ?></p>
                        <?php if(!empty($meta_main_url)): ?><p><?php echo $meta_main_url ?></p><?php endif ?>
                        <?php if(!empty($meta_app_download)): ?> <p><?php echo $meta_app_download ?></p><?php endif ?>
                    </div>
                    <?php endif ?>

                </div>




                    <div class="row post-meta-author">
                        <h2 class="col-xs-12"><?php echo __('Chceš vědět více o autorech projektu?'); ?></h2>

                        <div class="post-inline-attachment post-inline-widget post-authors-container col-xs-12">

                                <?php $authors_ids = explode(',', get_post_meta($post->ID, 'project_author', true)); ?>


                                    <?php foreach ($authors_ids as $author_id): ?>
                                    <?php

                                        $post_author = get_post( $author_id );
                                    ?>
                                        <?php if (has_post_thumbnail( $post_author ->ID ) ): ?>
                                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_author ->ID ), 'item-detail-aside' ); ?>
                                            <div class="post-detail-author">
                                                <a href="<?php echo get_permalink($post_author);?>">
                                                    <img src="<?php echo $image[0]; ?>">
                                                    <span class="post-detail-author-title"><?php echo $post_author->post_title ?></span>
                                                </a>
                                            </div>

                                        <?php endif; ?>

                                    <?php endforeach; ?>


                        </div>
                    </div>

            </div>

        </div>


        <section class="section content-block block-with-title block-border">

                        <div class="col-title">
                            <h3 class="section-title"><?php _e('Další podobné projekty') ?></h3>

                        </div>

                        <div class="col-content">


                            <div class="row ">

                        <?php
                            // filter Naše projekty category (id 14) which is a default one used for displaying all projects
                            $this_project_categories = array_filter(get_the_category(), function($item) {
                                return ($item->term_id !== 14);
                            });

                            $this_project_categories_ids = array_map(function($item) {return $item->term_id;}, $this_project_categories);

                        ?>

                        <?php $the_query = new WP_Query( array( 'post_type' => 'projekt', 'post__not_in'=> array($post->ID), 'category__in' => $this_project_categories_ids, 'posts_per_page' => 8 ) ); ?>
                            <?php
                                    if ( $the_query->have_posts() ): ?>

                                <?php while ( $the_query->have_posts() ) : ?>
                                    <?php $the_query->the_post(); ?>

                                        <div class="item-thumb item-with-image col-xs-6 col-md-3">

                                            <a href="<?php echo get_permalink(); ?>" class="item-link">

                                                <?php if (has_post_thumbnail( $post->ID ) ): ?>
                                                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'item-with-image' ); ?>
                                                        <?php $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>
                                                            <figure class="item-image item-news-image" data-url="<?php echo $image_full[0]; ?>">
                                                                <span class="item-link-hover-excerpt"><?php echo get_the_excerpt(); ?></span>
                                                                <img src="<?php echo $image[0]; ?>">
                                                            </figure>

                                                            <?php endif; ?>



                                                                <h2 class="item-title"><?php the_title() ?></h2>




                                            </a>
                                        </div>

                                        <?php endwhile; ?>

                                            <?php else: ?>
                                                // no posts found
                                                <?php endif; ?>

                                                    <?php /* Restore original Post Data */ wp_reset_postdata(); ?>


                            </div>


                            <div class="section-more"><a href="<?php bloginfo('url'); ?>/vyzkum-projekty-akce/nase-projekty" class="link-section-more">Všechny projekty</a></div>

                        </div>

                    </section>


    </article>
