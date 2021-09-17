<?php
/**
 * Template Name: Suche
 */
wp_enqueue_style('search', get_template_directory_uri() . '/search.css');
wp_enqueue_style('cards', get_template_directory_uri() . '/css/cards.css');
wp_enqueue_style('tags', get_template_directory_uri() . '/css/tags.css');
wp_enqueue_style('pagination', get_template_directory_uri() . '/css/pagination.css');

get_header();
?>
<header class="search-header section grey lighten-3">
	<div class="container center">
		<h1><?php echo $wp_query->found_posts; ?> Treffer</h1>
		für "<?php echo get_search_query(true); ?>"
	</div>
</header>
<main class="section container">
	<section>
	<?php
		echo '<div class="teaser-row">';
		while (have_posts()) {
			the_post();
			the_teaser_entry(array('col', 'l6'));
		}
		echo '</div>';;
	?>
	<?php phoenix_pagination($wp_query->max_num_pages); ?>
	</section>
</main>
<?php get_footer(); ?>