<?php
/*
Template Name: Akce List
*/

get_header(); ?>

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

       
                get_template_part( 'template-parts/content', 'page-akce' );

          
		endwhile;
		?>

<?php get_footer(); ?>
