<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article>
			<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<?php the_content(); ?>
		</article>
	<?php endwhile; ?>
<?php else : ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
