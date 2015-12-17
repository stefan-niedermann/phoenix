<?php get_header(); ?>
	<article>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'page' ); ?>
		<?php endwhile; ?>
	</article>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
