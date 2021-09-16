<?php
/**
 * Template Name: Archiv-Seiten
 * Auflistung von Artikeln in einer bestimmten Kategorie oder mit einem bestimmten Tag.
 */

/* Set News to current Menu Item */
add_filter( 'nav_menu_css_class', 'get_news_nav_class', 10, 2 );

wp_enqueue_style('teaser', get_template_directory_uri().'/css/teaser.css' );

get_header();
?>
<main class="container">
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
