<?php
/*
Template Name: Akce UK List
*/

get_header(); ?>

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

       
                get_template_part( 'template-parts/content', 'page-akce-uk' );

          
		endwhile;
		?>

<?php get_footer(); ?>
