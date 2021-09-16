<?php

/**
 * Template Name: 404
 * Handelt einen 404-Fehler
 */
wp_enqueue_style('teaser', get_template_directory_uri() . '/css/teaser.css');
get_header(); ?>
<main class="container flow-text">
	<h1>Die gesuchte Seite wurde nicht gefunden</h1>
	<p>Hoppla, die gesuchte Seite konnten wir leider nicht finden. Entweder ist sie unter einer neuen Adresse verfügbar oder sie hat nie existiert.</p>
	<p>Möchten Sie stattdessen auf unsere <a href="/" title="Startseite">Startseite</a> gehen?</p>
	<p>Wenn Sie der Meinung sind, dass dies ein Fehler von uns ist, können Sie uns gerne kontaktieren. Möglichkeiten zur Kontaktaufnahmen finden Sie im <a href="/impressum/#verantwortlich">Impressum</a>.</p>
</main>
<section class="section grey lighten-4">
	<div class="container teaser-row">
		<?php
		$teaserquery = new WP_Query(array(
			'posts_per_page' => 2,
			'post_type' => 'post',
			'post_status' => 'publish'
		));
		while ($teaserquery->have_posts()) {
			$teaserquery->the_post();
			$classes= array('col l6');
			the_teaser($classes);
		}
		wp_reset_postdata();
		?>
	</div>
</section>
<?php get_footer(); ?>