<?php
/**
 * The template for displaying all single posts.
 *
 * @package aegis
 */

get_header(); ?>

	<?php wrapper_main(); ?>
		

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php aegis_post_nav(); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

	<?php end_wrapper_main(); ?>

	<?php wrapper_aside(); ?>
		<?php get_sidebar(); ?>
	<?php end_wrapper_aside(); ?>

<?php get_footer(); ?>
