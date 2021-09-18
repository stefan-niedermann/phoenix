<?php
/**
 * Template Name: Archiv-Seiten
 * Auflistung von Artikeln in einer bestimmten Kategorie oder mit einem bestimmten Tag.
 */

/* Set News to current Menu Item */
add_filter( 'nav_menu_css_class', 'get_news_nav_class', 10, 2 );

wp_enqueue_style('archive', get_template_directory_uri() . '/archive.css');
wp_enqueue_style('cards', get_template_directory_uri() . '/css/cards.css');
wp_enqueue_style('tags', get_template_directory_uri() . '/css/tags.css');
wp_enqueue_style('pagination', get_template_directory_uri() . '/css/pagination.css');

get_header();
?>
<main class="grey lighten-4">
	<div class="container">
		<ol class="breadcrumbs flow-text">
			<li>
				<span><a href="/news">News</a></span>
			</li>
			<li>
				<span><?php
				if(is_tag()) {
					echo 'Tags';
				} elseif(is_category()) {
					echo 'Kategorien';
				}
				?></span>
			</li>
			<li>
				<span><?php echo single_cat_title("", false); ?></span>
			</li>
		</ol>
	</div>
	<section class="container">
		<div class="teaser-row">
		<?php
			while (have_posts()) {
				the_post();
				the_teaser_entry(array('col', 'l6'));
			}
		?>
		</div>
	<?php phoenix_pagination($wp_query->max_num_pages); ?>
	</section>
</main>
<?php get_footer(); ?>
