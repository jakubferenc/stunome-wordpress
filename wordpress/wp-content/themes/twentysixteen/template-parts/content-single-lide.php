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


                                <ul>
                                    <li>Puc J., Roreitner R., Rabas M., Javorská A., Miškovský M., Fridmanová M., Martínková I., Šlerka J., Chavalka J., Sepp H., Lomozová P.: Filosofie lidského, příliš lidského. Červený Kostelec, Pavel Mervart, 2011. 233 s. • p. ISBN 978-80-87378-86-1.</li>
                                    <li>Šlerka J.: <em>Patos distance jako cíl rétorické strategie</em>. In Puc J., Fridmanová M.: Filosofie lidského, příliš lidského. Červený Kostelec, Pavel Mervart, 2011, s. • p. 147-158. ISBN 978-80-87378-86-1.</li>
                                    <li>Šlerka J.: <em>Karel Čapek and semiotics</em>. In Doubravová J., Schuster R.: Cultures as Sign Systems and Processes : transdisciplinary Czech-Austrian symposium in Linz in the focus "inter.kultur" and the series "Open Borders". Plzeň, University of West Bohemia, 2011, s. • p. 37-53. ISBN 978-80-7043-924-1.</li>
                                    <li>Šlerka J., Smolík F.: <em>Automatická měřítka čitelnosti pro česky psané texty</em>. Studie z aplikované lingvistiky, 2010, č. • no. 1, s. • p. 33 - 44. ISSN 1804-3240.</li>

                                    <li>Puc J., Roreitner R., Rabas M., Javorská A., Miškovský M., Fridmanová M., Martínková I., Šlerka J., Chavalka J., Sepp H., Lomozová P.: Filosofie lidského, příliš lidského. Červený Kostelec, Pavel Mervart, 2011. 233 s. • p. ISBN 978-80-87378-86-1.</li>
                                    <li>Šlerka J.: <em>Patos distance jako cíl rétorické strategie</em>. In Puc J., Fridmanová M.: Filosofie lidského, příliš lidského. Červený Kostelec, Pavel Mervart, 2011, s. • p. 147-158. ISBN 978-80-87378-86-1.</li>
                                    <li>Šlerka J.: <em>Karel Čapek and semiotics</em>. In Doubravová J., Schuster R.: Cultures as Sign Systems and Processes : transdisciplinary Czech-Austrian symposium in Linz in the focus "inter.kultur" and the series "Open Borders". Plzeň, University of West Bohemia, 2011, s. • p. 37-53. ISBN 978-80-7043-924-1.</li>
                                    <li>Šlerka J., Smolík F.: <em>Automatická měřítka čitelnosti pro česky psané texty</em>. Studie z aplikované lingvistiky, 2010, č. • no. 1, s. • p. 33 - 44. ISSN 1804-3240.</li>

                                </ul>


                            </div>
                            <div id="rozvrh" class="tab-pane section-content post-section-content">


                                <ul>
                                    <li>Puc J., Roreitner R., Rabas M., Javorská A., Miškovský M., Fridmanová M., Martínková I., Šlerka J., Chavalka J., Sepp H., Lomozová P.: Filosofie lidského, příliš lidského. Červený Kostelec, Pavel Mervart, 2011. 233 s. • p. ISBN 978-80-87378-86-1.</li>
                                    <li>Šlerka J.: <em>Patos distance jako cíl rétorické strategie</em>. In Puc J., Fridmanová M.: Filosofie lidského, příliš lidského. Červený Kostelec, Pavel Mervart, 2011, s. • p. 147-158. ISBN 978-80-87378-86-1.</li>
                                    <li>Šlerka J.: <em>Karel Čapek and semiotics</em>. In Doubravová J., Schuster R.: Cultures as Sign Systems and Processes : transdisciplinary Czech-Austrian symposium in Linz in the focus "inter.kultur" and the series "Open Borders". Plzeň, University of West Bohemia, 2011, s. • p. 37-53. ISBN 978-80-7043-924-1.</li>
                                    <li>Šlerka J., Smolík F.: <em>Automatická měřítka čitelnosti pro česky psané texty</em>. Studie z aplikované lingvistiky, 2010, č. • no. 1, s. • p. 33 - 44. ISSN 1804-3240.</li>

                                    <li>Puc J., Roreitner R., Rabas M., Javorská A., Miškovský M., Fridmanová M., Martínková I., Šlerka J., Chavalka J., Sepp H., Lomozová P.: Filosofie lidského, příliš lidského. Červený Kostelec, Pavel Mervart, 2011. 233 s. • p. ISBN 978-80-87378-86-1.</li>
                                    <li>Šlerka J.: <em>Patos distance jako cíl rétorické strategie</em>. In Puc J., Fridmanová M.: Filosofie lidského, příliš lidského. Červený Kostelec, Pavel Mervart, 2011, s. • p. 147-158. ISBN 978-80-87378-86-1.</li>
                                    <li>Šlerka J.: <em>Karel Čapek and semiotics</em>. In Doubravová J., Schuster R.: Cultures as Sign Systems and Processes : transdisciplinary Czech-Austrian symposium in Linz in the focus "inter.kultur" and the series "Open Borders". Plzeň, University of West Bohemia, 2011, s. • p. 37-53. ISBN 978-80-7043-924-1.</li>
                                    <li>Šlerka J., Smolík F.: <em>Automatická měřítka čitelnosti pro česky psané texty</em>. Studie z aplikované lingvistiky, 2010, č. • no. 1, s. • p. 33 - 44. ISSN 1804-3240.</li>

                                </ul>


                            </div>
                            <div id="vyucovane-predmety" class="tab-pane section-content post-section-content">


                                <ul>
                                    <li>Puc J., Roreitner R., Rabas M., Javorská A., Miškovský M., Fridmanová M., Martínková I., Šlerka J., Chavalka J., Sepp H., Lomozová P.: Filosofie lidského, příliš lidského. Červený Kostelec, Pavel Mervart, 2011. 233 s. • p. ISBN 978-80-87378-86-1.</li>
                                    <li>Šlerka J.: <em>Patos distance jako cíl rétorické strategie</em>. In Puc J., Fridmanová M.: Filosofie lidského, příliš lidského. Červený Kostelec, Pavel Mervart, 2011, s. • p. 147-158. ISBN 978-80-87378-86-1.</li>
                                    <li>Šlerka J.: <em>Karel Čapek and semiotics</em>. In Doubravová J., Schuster R.: Cultures as Sign Systems and Processes : transdisciplinary Czech-Austrian symposium in Linz in the focus "inter.kultur" and the series "Open Borders". Plzeň, University of West Bohemia, 2011, s. • p. 37-53. ISBN 978-80-7043-924-1.</li>
                                    <li>Šlerka J., Smolík F.: <em>Automatická měřítka čitelnosti pro česky psané texty</em>. Studie z aplikované lingvistiky, 2010, č. • no. 1, s. • p. 33 - 44. ISSN 1804-3240.</li>

                                    <li>Puc J., Roreitner R., Rabas M., Javorská A., Miškovský M., Fridmanová M., Martínková I., Šlerka J., Chavalka J., Sepp H., Lomozová P.: Filosofie lidského, příliš lidského. Červený Kostelec, Pavel Mervart, 2011. 233 s. • p. ISBN 978-80-87378-86-1.</li>
                                    <li>Šlerka J.: <em>Patos distance jako cíl rétorické strategie</em>. In Puc J., Fridmanová M.: Filosofie lidského, příliš lidského. Červený Kostelec, Pavel Mervart, 2011, s. • p. 147-158. ISBN 978-80-87378-86-1.</li>
                                    <li>Šlerka J.: <em>Karel Čapek and semiotics</em>. In Doubravová J., Schuster R.: Cultures as Sign Systems and Processes : transdisciplinary Czech-Austrian symposium in Linz in the focus "inter.kultur" and the series "Open Borders". Plzeň, University of West Bohemia, 2011, s. • p. 37-53. ISBN 978-80-7043-924-1.</li>
                                    <li>Šlerka J., Smolík F.: <em>Automatická měřítka čitelnosti pro česky psané texty</em>. Studie z aplikované lingvistiky, 2010, č. • no. 1, s. • p. 33 - 44. ISSN 1804-3240.</li>

                                </ul>


                            </div>

                        </div>



                    </section>

                    <?php endif; ?>



            </div>


            <div class="post-inline-attachment post-aside col-md-4 col-md-offset-1">


                <div class="post-inline-widget">

                    <p><strong><?php the_title() ?></strong></p>
                    
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