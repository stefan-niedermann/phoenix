<?php

/**
 * Template Name: Autoren
 * Deteilinformationen und Beschreibungen über die Autoren der Artikel.
 */

wp_enqueue_style('author', get_template_directory_uri() . '/author.css');
wp_enqueue_style('cards', get_template_directory_uri() . '/css/cards.css');
wp_enqueue_style('tags', get_template_directory_uri() . '/css/tags.css');
get_header();
?>
<main class="section">
	<div class="flow-text container">
		<h1><?php the_author_meta('display_name'); ?></h1>
		<p><?php the_author_meta('description'); ?></p>
		<?php if (!empty(get_the_author_meta("user_url"))) { ?>
			<h2>Website</h2>
			<ul class="author-meta">
				<li><a href="<?php the_author_meta('user_url'); ?>"><i class="material-icons">public</i><?php the_author_meta('user_url'); ?></a></li>
			</ul>
		<?php } ?>
	</div>
</main>
<section class="section grey lighten-4">
	<div class="container">
		<div class="teaser-row">
		<?php
			$teaserquery = new WP_Query(array(
				'posts_per_page' => 6,
				'post_type' => 'post',
				'post_status' => 'publish',
				'author' => get_the_author_meta("id")
			));
			while ($teaserquery->have_posts()) {
				$teaserquery->the_post();
				the_teaser_entry(array('col', 'l6'));
			}
			wp_reset_postdata();
		?>
		</div>
	</div>
</section>
<?php get_footer(); ?>