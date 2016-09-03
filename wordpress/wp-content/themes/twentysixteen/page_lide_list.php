<?php
/*
Template Name: Lide List
*/

get_header(); ?>

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'template-parts/content', 'page-lide' );

			// End of the loop.
		endwhile;
		?>

<?php get_footer(); ?>
