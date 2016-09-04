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

                <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>

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

                   
                        <?php $the_query = new WP_Query( array( 'post_type' => 'osoba', 'category_name' => $pagename, 'posts_per_page' => -1 ) ); ?>
                            <?php 
                                    if ( $the_query->have_posts() ): ?>

                                <?php while ( $the_query->have_posts() ) : ?>
                                    <?php $the_query->the_post(); ?>

                                            <?php $full_academic_name = get_full_academic_name($post->ID); ?>

                                            <div class="col-xs-6 col-md-3">
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

            </div>


        </div>

