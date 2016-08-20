<?php
/*
Template Name: Blogs List
*/

get_header(); ?>

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

       
                get_template_part( 'template-parts/content', 'page-blogs' );

          
		endwhile;
		?>

<?php get_footer(); ?>
