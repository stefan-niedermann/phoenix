<?php
/**
 * Template Name: Autoren
 * Deteilinformationen und Beschreibungen über die Autoren der Artikel.
 */

wp_enqueue_style( 'author', get_template_directory_uri() . '/author.css' );
get_header();
?>
<main>
	<section>
		<h1><?php the_author_meta('display_name'); ?></h1>
		<p><?php the_author_meta('description'); ?></p>
		<?php if(!empty(get_the_author_meta("user_url"))) { ?>
			<h2>Website</h2>
			<p><a href="<?php the_author_meta('user_url'); ?>"><?php the_author_meta('user_url'); ?></a></p>
		<?php } ?>
		<h2>Letzte Artikel</h2>
	<?php
		$teaserquery = new WP_Query(array(
			'posts_per_page' => 20,
			'post_type' => 'post',
			'post_status' => 'publish',
			'author' => get_the_author_meta("id")
		));
		echo "<ul class=\"colored\">";
		while ( $teaserquery->have_posts() ) {
      			$teaserquery->the_post();
			$date = sprintf( '<time class="entry-date" datetime="%1$s">%2$s</time>',
				esc_attr( get_the_date( "c" ) ),
				esc_html( get_the_date( "d.m.Y") )
			);
			echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a><span class="catlist-date">' . $date . '</span></li>';
		}
		echo "</ul>";
	?>
	</section>
</main>
<?php get_footer(); ?>