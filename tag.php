<?php
/**
 * Template Name: Tags
 * Auflistung von Artikeln mit einem bestimmten Tag.
 */

/* Set News to current Menu Item */
add_filter( 'nav_menu_css_class', 'get_news_nav_class', 10, 2 );

get_header();
?>
<main>
	<nav class="breadcrumbs">
		<ol>
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
	</nav>
	<section>
	<?php
		$teaserquery = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'post',
			'post_status' => 'publish',
			'tag_id' => get_the_tags()[0]->term_id
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
