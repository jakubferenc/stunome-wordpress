<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?>

<?php
/*
Template Name: Redirect To First Child
*/
if (have_posts()) {
  while (have_posts()) {
    the_post();
    $page_children = get_pages("child_of=".$post->ID."&sort_column=menu_order");
      
      if ($page_children) {
          
          $firstchild = $page_children [0];
          wp_redirect(get_permalink($firstchild->ID));
          exit;
      }
      
   
    
      
  }
}
?>   
<!--
   /$$ /$$         /$$   /$$                               /$$      /$$                 /$$ /$$                  /$$$$$$   /$$                     /$$ /$$                           /$$      
  / $$/ $$        | $$$ | $$                              | $$$    /$$$                | $$|__/                 /$$__  $$ | $$                    | $$|__/                          | $$      
 /$$$$$$$$$$      | $$$$| $$  /$$$$$$  /$$  /$$  /$$      | $$$$  /$$$$  /$$$$$$   /$$$$$$$ /$$  /$$$$$$       | $$  \__//$$$$$$   /$$   /$$  /$$$$$$$ /$$  /$$$$$$   /$$$$$$$      | $$      
|   $$  $$_/      | $$ $$ $$ /$$__  $$| $$ | $$ | $$      | $$ $$/$$ $$ /$$__  $$ /$$__  $$| $$ |____  $$      |  $$$$$$|_  $$_/  | $$  | $$ /$$__  $$| $$ /$$__  $$ /$$_____/      |__/      
 /$$$$$$$$$$      | $$  $$$$| $$$$$$$$| $$ | $$ | $$      | $$  $$$| $$| $$$$$$$$| $$  | $$| $$  /$$$$$$$       \____  $$ | $$    | $$  | $$| $$  | $$| $$| $$$$$$$$|  $$$$$$        /$$      
|_  $$  $$_/      | $$\  $$$| $$_____/| $$ | $$ | $$      | $$\  $ | $$| $$_____/| $$  | $$| $$ /$$__  $$       /$$  \ $$ | $$ /$$| $$  | $$| $$  | $$| $$| $$_____/ \____  $$      | $$      
  | $$| $$        | $$ \  $$|  $$$$$$$|  $$$$$/$$$$/      | $$ \/  | $$|  $$$$$$$|  $$$$$$$| $$|  $$$$$$$      |  $$$$$$/ |  $$$$/|  $$$$$$/|  $$$$$$$| $$|  $$$$$$$ /$$$$$$$/      | $$      
  |__/|__/        |__/  \__/ \_______/ \_____/\___/       |__/     |__/ \_______/ \_______/|__/ \_______/       \______/   \___/   \______/  \_______/|__/ \_______/|_______/       |__/      
                                                                                                                                                                                              
                                                                                                                                                                                              
                                                                                                                                                                                              
 /$$$$$$$$ /$$$$$$$$       /$$   /$$ /$$   /$$                                                                                                                                                
| $$_____/| $$_____/      | $$  | $$| $$  /$$/                                                                                                                                                
| $$      | $$            | $$  | $$| $$ /$$/                                                                                                                                                 
| $$$$$   | $$$$$         | $$  | $$| $$$$$/                                                                                                                                                  
| $$__/   | $$__/         | $$  | $$| $$  $$                                                                                                                                                  
| $$      | $$            | $$  | $$| $$\  $$                                                                                                                                                 
| $$      | $$            |  $$$$$$/| $$ \  $$                                                                                                                                                
|__/      |__/             \______/ |__/  \__/                                                                                                                                                
                                                                                                                                                                                              
                                                                                                                                                                                              
                                                                                                                                                                                              
     /$$$$$$                 /$$                                                                                                                                                              
   /$$$__  $$$              | $$                                                                                                                                                              
  /$$_/  \_  $$   /$$$$$$$ /$$$$$$   /$$   /$$ /$$$$$$$   /$$$$$$  /$$$$$$/$$$$   /$$$$$$                                                                                                     
 /$$/ /$$$$$  $$ /$$_____/|_  $$_/  | $$  | $$| $$__  $$ /$$__  $$| $$_  $$_  $$ /$$__  $$                                                                                                    
| $$ /$$  $$| $$|  $$$$$$   | $$    | $$  | $$| $$  \ $$| $$  \ $$| $$ \ $$ \ $$| $$$$$$$$                                                                                                    
| $$| $$\ $$| $$ \____  $$  | $$ /$$| $$  | $$| $$  | $$| $$  | $$| $$ | $$ | $$| $$_____/                                                                                                    
| $$|  $$$$$$$$/ /$$$$$$$/  |  $$$$/|  $$$$$$/| $$  | $$|  $$$$$$/| $$ | $$ | $$|  $$$$$$$                                                                                                    
|  $$\________/ |_______/    \___/   \______/ |__/  |__/ \______/ |__/ |__/ |__/ \_______/                                                                                                    
 \  $$$   /$$$                                                                                                                                                                                
  \_  $$$$$$_/                                                                                                                                                                                
    \______/                                                                                                                                                                                  

Don't be evil, become StuNoMe!: http://www.snmprijimacky.cz

Stunome není jen škola, je to životní styl


-->   
    <!doctype html>
    
    
    <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"  <?php language_attributes(); ?>> <![endif]-->
    <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"  <?php language_attributes(); ?>> <![endif]-->
    <!--[if IE 8]>         <html class="no-js lt-ie9"  <?php language_attributes(); ?>> <![endif]-->
    <!--[if gt IE 8]><!-->
    <html class="no-js" <?php language_attributes(); ?>>
    <!--<![endif]-->

    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
            <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
            <?php endif; ?>
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
                <meta name="description" content="">
                <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
                <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
                <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
                <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
                <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
                <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
                <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
                <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
                <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
                <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
                <link rel="icon" type="image/png" sizes="192x192" href="/android-icon-192x192.png">
                <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
                <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
                <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
                <link rel="manifest" href="/manifest.json">
                <meta name="msapplication-TileColor" content="#ffffff">
                <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
                <meta name="theme-color" content="#ffffff">
   
                <script src="<?php echo get_template_directory_uri() ?>/src/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

                <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->


        <div class="header-top">

            <div class="slider">

                <div class="slide slide-people-heads">
                
                   
                        <?php $the_query = new WP_Query( array( 'post_type' => 'osoba', 'posts_per_page' => -1, 'orderby' => 'rand') ); ?>
                            <?php 
                                    if ( $the_query->have_posts() ): ?>

                                <?php while ( $the_query->have_posts() ) : ?>
                                    <?php $the_query->the_post(); ?>

                                           <?php $twitter_username = get_post_meta( get_the_ID(), 'twitter_username', true ); ?>
                                           <?php $twitter_description = get_post_meta( get_the_ID(), 'twitter_description', true ); ?>
                                                       
                                                       
                                            <?php $twitter_desc = ( ! empty ( $post->content ) ) ? $post->content : $twitter_description; ?>
    
                                                        <?php if (has_post_thumbnail( $post->ID ) ): ?>
                                                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'item-with-image' ); ?>
                                                            <?php $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>
                                            
                                                            <a href="<?php echo get_permalink( $post->ID) ?>" class="person-head" style="background-image: url(<?php echo $image[0]; ?>)">

                                                         <?php else: ?>

                                                            <a href="<?php echo get_permalink( $post->ID) ?>" class="person-head" style="background-image: url(<?php echo get_template_directory_uri() ?>/img/profile_picture_default.png?>)">

                                                        <?php endif; ?>

                                                                            <span class="twitter-info"><?php echo $twitter_desc ?></span>
                                            <?php if ( ! empty(  $twitter_username ) ): ?>
                                             <span class="username">@<?php echo $twitter_username ?></span>  
                                            <?php endif; ?>    
                                            
                                        </a>                                                 
         

                                        <?php endwhile; ?>

                                            <?php else: ?>
                                                // no posts found
                                                <?php endif; ?>

                                                    <?php /* Restore original Post Data */ wp_reset_postdata(); ?>                


                </div>

                <div class="slide main-menu-slide main-menu-block">

                    <div class="main-wrapper">

                        <nav role="navigation">

                            <div class="container container-wider">

                               
                                <!--<div class="row">


                                    <div class="col-xs-12 col-md-3 col-main-menu">


                                        <div class="main-menu-title">
                                            <p><a href="#">O oboru</a></p>
                                        </div>

                                        <ul class="nav menu-submenu hidden-xs hidden-sm">
                                            <li><a href="#">Historie</a></li>
                                            <li><a href="#">Charakteristika oboru</a></li>
                                            <li><a href="#">Jednoobor/dvouobor</a></li>
                                            <li><a href="#">Profilace</a></li>
                                            <li><a href="#">Profily absolventek a absolventů</a></li>

                                        </ul>

                                    </div>

                                    <div class="col-xs-12 col-md-3 col-main-menu">


                                        <div class="main-menu-title">
                                            <p><a href="#">Lidé</a></p>
                                        </div>

                                    </div>


                                    <div class="col-xs-12 col-md-3 col-main-menu">


                                        <div class="main-menu-title">
                                            <p><a href="#">Studium</a></p>
                                        </div>

                                        <ul class="nav menu-submenu hidden-xs hidden-sm">
                                            <li><a href="#">Rozvrh a harmonogram semestru</a></li>
                                            <li><a href="#">Zápis předmětů</a></li>
                                            <li><a href="#">Jak vystudovat</a></li>
                                            <li><a href="http://uisk.ff.cuni.cz/listing.do?categoryId=14908">Rigorózní řízení <i class="fa fa-external-link"></i></a></li>
                                            <li><a href="#">Erasmus a studium v zahraničí</a></li>
                                            <li><a href="http://www.ff.cuni.cz/studium/stipendia/">Stipendium <i class="fa fa-external-link"></i></a></li>
                                            <li><a href="#">Užitečné odkazy</a></li>
                                            <li><a href="#">Stipendium</a></li>
                                            <li><a href="#">Rigorózní řízení </a></li>
                                            <li><a href="#">Ubytování při studiu</a></li>
                                            <li><a href="#">Užitečné odkazy</a></li>
                                        </ul>

                                    </div>

                                    <div class="col-xs-12 col-md-3 col-main-menu">


                                        <div class="main-menu-title">
                                            <p><a href="#">Uchazeč</a></p>
                                        </div>

                                        <ul class="nav menu-submenu hidden-xs hidden-sm">
                                            <li><a href="#">Charakteristika oboru</a></li>
                                            <li><a href="#">Profil absolventa</a></li>
                                            <li><a href="#">Přijímací řízení</a></li>
                                            <li><a href="#">Aplikace #SNMPrijimacky</a></li>
                                        </ul>

                                    </div>

                                </div>
                                
                                <div class="row">

                                    <div class="col-xs-12 col-md-3 col-main-menu">


                                        <div class="main-menu-title">
                                            <p><a href="#">Výzkum, projekty, akce</a></p>
                                        </div>

                                        <ul class="nav menu-submenu hidden-xs hidden-sm">
                                            <li><a href="#">Výzkumné záměry</a></li>
                                            <li><a href="#">Grantové projekty</a></li>
                                            <li><a href="#">Studentské projekty</a></li>
                                            <li><a href="#">Naše časopisy</a></li>
                                            <li><a href="#">Pořádáme</a></li>
                                            <li><a href="#">Pravidelné #SNM akce</a></li>
                                        </ul>

                                    </div>


                                    <div class="col-xs-12 col-md-3 col-main-menu">


                                        <div class="main-menu-title">
                                            <p><a href="#">FAQ</a></p>
                                        </div>


                                    </div>

                                    <div class="col-xs-12 col-md-3 col-main-menu">


                                        <div class="main-menu-title">
                                            <p><a href="#">Kontakt</a></p>
                                        </div>

                                        <ul class="nav menu-submenu hidden-xs hidden-sm">
                                            <li><a href="#">Přijďte za námi</a></li>
                                            <li><a href="#">Napište nám</a></li>
                                            <li><a href="#">Kontaktní formulář</a></li>
                                            <li><a href="#">Sledujte nás</a></li>
                                        </ul>

                                    </div>

                                </div>-->
                                
                                
                                <?php clean_custom_menu("primary"); ?>


                           
                            </div>


                        </nav>

                    </div>

                </div>

            </div>

        </div>

        <div class="main-wrapper clearfix">

            <div class="page-wrapper">

                <header class="main-header sticky-el" role="banner">

                    <div class="container  container-wider">

                        <div class="row container-header vertical-align">

                            <div class="col-xs-4">
                                <a class="logo" href="<?php echo get_home_url(); ?>">
                                <img src="<?php echo get_template_directory_uri() ?>/dist/img/logo_original.png">
                            </a>
                            </div>


                            <div class="col-xs-8 ">

                                <div class="row vertical-align">
                                    <div class="hidden-xs hidden-sm header-quick-links col-md-8">

                                        <p>Rychlé odkazy:</p>
                                         <?php                            
                                        wp_nav_menu( array(
                                            'theme_location' => 'quick-links',
                                            'items_wrap'     => '<ul class="nav">%3$s</ul>'
                                        ) );                                        
                                        ?>                       
                  

                                    </div>

                                    <div class="header-switches col-xs-12 col-md-4">

                                        <a href="#" class="header-switch header-switch-top">
                                            <svg class="icon" width="35" height="32">
                                                <use class="icon-arrow" xlink:href="<?php echo get_template_directory_uri() ?>/dist/img/icons.svg#arrow" />
                                            </svg>
                                        </a>

                                        <a href="#" class="header-switch header-switch-menu">
                                            <svg class="icon" width="30" height="38">
                                                <use class="icon-burger" xlink:href="<?php echo get_template_directory_uri() ?>/dist/img/icons.svg#burger" />
                                            </svg>

                                        </a>


                                    </div>


                                </div>


                            </div>

                        </div>

                    </div>
                    <div class="gradient-bg"></div>
                </header>


                <main class="content-main">

                    <div class="container container-wider">

                        <div class="page-main-header">

                            <div class="row visible-xs visible-sm">
                               
                                <div class="col-sm-6">

                                    <div class="header-quick-links header-quick-links-mobile">


                                        <p>Rychlé odkazy:</p>
                                         <?php                            
                                        wp_nav_menu( array(
                                            'theme_location' => 'quick-links',
                                            'items_wrap'     => '<ul class="nav">%3$s</ul>'
                                        ) );                                        
                                        ?> 

                                    </div>
                                
                                </div>    
                                <div class="col-sm-6">    
                                    
                                    <div class="header-quick-mobile-social-links">
                                        <p>Jsme na sociálních sítích</p>
                                        <div class="social-icons">
                                            
                                            <a href="#" class="social-icon-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                            <a href="#" class="social-icon-facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                            <a href="#" class="social-icon-youtube"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                                            <a href="#" class="social-icon-slideshare"><i class="fa fa-slideshare" aria-hidden="true"></i></a>

                                        </div>
                                        
                                    </div>


                                </div>


                            </div>



                            <div class="breadcrumbs-container">
                                <!-- BREADCRUMBS -->
                                <div class="nav breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">

                                    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>

                                </div>
                                <!-- END BREADCRUMBS -->
                            </div>

                        </div>