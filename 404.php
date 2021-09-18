<?php

/**
 * Template Name: 404
 * Handelt einen 404-Fehler
 */
wp_enqueue_style('cards', get_template_directory_uri() . '/css/cards.css');
wp_enqueue_style('tags', get_template_directory_uri() . '/css/tags.css');
get_header(); ?>
<main class="container flow-text">
	<h1 class="section center">Seite nicht gefunden</h1>
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
			the_teaser_entry(array('col', 'l6'));
		}
		wp_reset_postdata();
		?>
	</div>
</section>
<?php get_footer(); ?>