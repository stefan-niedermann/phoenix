<?php

/**
 * Template Name: Tags
 * Auflistung von Artikeln mit einem bestimmten Tag.
 */

// Single Style
wp_enqueue_style('tag', get_template_directory_uri() . '/tag.css');
wp_enqueue_style('teaser', get_template_directory_uri() . '/css/teaser.css');
/* Set News to current Menu Item */
add_filter('nav_menu_css_class', 'get_news_nav_class', 10, 2);

get_header();
?>
<main class="container flow-text">
	<ol class="breadcrumbs">
		<li>
			<span><a href="/news">News</a></span>
		</li>
		<li>
			<span>Tags</span>
		</li>
		<li>
			<span><?php echo single_cat_title("", false); ?></span>
		</li>
	</ol>
	<section>
		<?php
		$teaserquery = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'post',
			'post_status' => 'publish',
			'tag_id' => get_the_tags()[0]->term_id
		));
		echo '<div class="teaser-row">';
		while ($teaserquery->have_posts()) {
			$teaserquery->the_post();
			the_teaser_entry(array('col l6'));
		}
		echo '</div>';
		?>
	</section>
</main>
<?php get_footer(); ?>