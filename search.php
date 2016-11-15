<?php
/**
 * Template Name: Suche
 */

// Search Style
wp_enqueue_style('search', get_template_directory_uri().'/search.css' );
get_header(); ?>
<main>
<?php if ( have_posts() ) { ?>
	<?php while ( have_posts() ) { the_post();
		$thumbnail = get_the_post_thumbnail(get_the_ID(), 'thumbnail');
		if(!empty($thumbnail)) {
			echo '<article id="post-';
			the_ID();
			echo '" ';
			post_class("with-thumbnail");
			echo '>';
		} else {
			echo '<article id="post-';
			the_ID();
			echo '" ';
			post_class();
			echo '>';
		}
		echo $thumbnail;
		echo '<header class="entry-header"><h1><a href="';
		echo get_permalink();
		echo '">';
		the_title();
		echo '</a></h1>';
		$link = sprintf( '<a class="perma" href="%1$s" title="%2$s">%1$s</a>',
			esc_url( get_permalink() ),
			esc_attr( get_the_time() )
		);
		echo $link;
		echo '</header><div class="entry-content">';
		$date = sprintf( '<time class="entry-date" datetime="%1$s">%2$s</time>',
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);
		echo $date;
		the_excerpt();
		echo '</div></article>';
	}
}
?>
</main>
<?php
get_footer();
?>