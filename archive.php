<?php
/**
 * Template Name: Fallback für Kategorien, Tags, ...
 * Auflistung von Artikeln in einer bestimmten Kategorie oder mit einem bestimmten Tag.
 */

/* Set News to current Menu Item */
add_filter( 'nav_menu_css_class', 'get_news_nav_class', 10, 2 );

get_header();

echo '<nav class="breadcrumbs">';
echo 'News » ';
if(is_tag()) {
	echo 'Tags';
} else if(is_category()) {
	echo 'Kategorie';
}
echo ' » ' . single_cat_title('', false);
echo '</nav>';
?>
	<section>
		<?php
			if(is_tag()) {
				echo do_shortcode('[catlist tags="' . single_cat_title('', false) . '" class="colored" orderby="date" date="yes" dateformat="d.m.Y" date_tag="span" date_class="catlist-date"][/catlist]');
			} else if(is_category()) { 
				echo do_shortcode('[catlist name="' . single_cat_title('', false) . '" class="colored" orderby="date" date="yes" dateformat="d.m.Y" date_tag="span" date_class="catlist-date"][/catlist]');
			}
		?>
	</section>
<?php get_footer(); ?>