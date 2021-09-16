<?php

/**
 * Template Name: Autoren
 * Deteilinformationen und Beschreibungen über die Autoren der Artikel.
 */

wp_enqueue_style('author', get_template_directory_uri() . '/author.css');
wp_enqueue_style('teaser', get_template_directory_uri() . '/css/teaser.css');
get_header();
?>
<main class="container flow-text">
	<h1><?php the_author_meta('display_name'); ?></h1>
	<p><?php the_author_meta('description'); ?></p>
	<?php if (!empty(get_the_author_meta("user_url"))) { ?>
		<h2>Website</h2>
		<p><a href="<?php the_author_meta('user_url'); ?>"><?php the_author_meta('user_url'); ?></a></p>
	<?php } ?>
	<h2>Letzte Artikel</h2>
	<?php
	$teaserquery = new WP_Query(array(
		'posts_per_page' => 6,
		'post_type' => 'post',
		'post_status' => 'publish',
		'author' => get_the_author_meta("id")
	));
	echo '<div class="teaser-row">';
	while ($teaserquery->have_posts()) {
		$teaserquery->the_post();
		the_teaser_entry(array('col', 'l6'));
	}
	wp_reset_postdata();
	echo "</div>";
	?>
</main>
<?php get_footer(); ?>