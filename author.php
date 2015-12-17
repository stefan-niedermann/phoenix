<?php
/**
 * Template Name: Autoren
 * Deteilinformationen und Beschreibungen über die Autoren der Artikel.
 */

wp_enqueue_style( 'author', get_template_directory_uri() . '/author.css' );
get_header();
?>
	<section>
		<h1><?php the_author_meta('display_name'); ?></h1>
		<p><?php the_author_meta('description'); ?></p>
		<h2>Website</h2>
		<p><a href="<?php the_author_meta('user_url'); ?>"><?php the_author_meta('user_url'); ?></a></p>
	</section>
<?php get_footer(); ?>