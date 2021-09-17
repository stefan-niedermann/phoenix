<?php
/**
 * Template Name: Suche
 */
wp_enqueue_style('search', get_template_directory_uri() . '/search.css');
wp_enqueue_style('cards', get_template_directory_uri() . '/css/cards.css');
wp_enqueue_style('tags', get_template_directory_uri() . '/css/tags.css');
wp_enqueue_style('pagination', get_template_directory_uri() . '/css/pagination.css');

get_header();

if(empty(get_search_query()) || empty($wp_query->found_posts)) {
?>
<main class="no-results container center">
	<form action="?">
		<input type="search" name="s" placeholder="Suchbegriff eingeben" value="<?php echo get_search_query(true); ?>">
		<button type="submit" class="btn-floating btn-large waves-effect waves-light red-4"><i class="material-icons">search</i></button>
	</form>
	<?php
	if(empty($wp_query->found_posts)) {
		echo '<p>Hierfür haben wir leider keine Ergebnisse.</p>';
	}
	?>
</main>
<?php
} else {
?>
<main>
	<div class="container">
		<ol class="flow-text breadcrumbs">
			<li>Suche</li>
			<li>"<?php echo get_search_query(true); ?>"</li>
			<li><?php echo $wp_query->found_posts; ?> Treffer</li>
		</ol>
	</div>
	<section class="container">
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
<?php } ?>
<?php get_footer(); ?>