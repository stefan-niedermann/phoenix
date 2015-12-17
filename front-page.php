<?php
/**
 * Template Name: Startseite
 * Kommt auf der Startseite zum Einsatz
 */
wp_enqueue_style( 'sidebar', get_template_directory_uri() . '/style/sidebar.css' );
get_header(); ?>
<?php if ( have_posts() ) { ?>
	<?php while ( have_posts() ) { the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</article>
	<?php }
}
echo "<div class=\"sidebar\">";
dynamic_sidebar("main-sidebar");
echo "</div>";
get_footer();
?>
