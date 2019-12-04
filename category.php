<?php
/**
 * Template Name: Kategorie-Seiten
 * Auflistung von Artikeln in einer bestimmten Kategorie.
 */

/* Set News to current Menu Item */
add_filter( 'nav_menu_css_class', 'get_news_nav_class', 10, 2 );

// Single Style
wp_enqueue_style('category', get_template_directory_uri().'/category.css' );
// Single Script
wp_enqueue_script( 'category', get_template_directory_uri() . '/category.js', array(), '0.0.1' );

get_header();
?>
<main class="container flow-text">
	<nav class="breadcrumbs">
		<ol>
			<li>
				<span><a href="/news">News</a></span>
			</li>
			<li>
				<span>Kategorien</span>
			</li>
			<li>
				<span><?php echo single_cat_title("", false); ?></span>
			</li>
		</ol>
	</nav>
	<section>
	<?php
		$teaserquery = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'post',
			'post_status' => 'publish',
			'cat' => get_the_category()[0]->cat_ID
		));
		echo "<ul class=\"colored\">";
		while ( $teaserquery->have_posts() ) {
      			$teaserquery->the_post();
			$date = sprintf( '<time class="entry-date" datetime="%1$s">%2$s</time>',
				esc_attr( get_the_date( "c" ) ),
				esc_html( get_the_date( "d.m.Y") )
			);
			echo '<li><span class="catlist-date">' . $date . '</span><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
		}
		echo "</ul>";
	?>
	</section>
</main>
<?php get_footer(); ?>
