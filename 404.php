<?php
/**
 * Template Name: 404
 * Handelt einen 404-Fehler
 */
wp_enqueue_style( 'sidebar', get_template_directory_uri() . '/style/sidebar.css' );
get_header(); ?>
<main>
	<h1>Die gesuchte Seite wurde nicht gefunden</h1>
	<p>Hoppla, die gesuchte Seite konnten wir leider nicht finden. Entweder ist sie unter einer neuen Adresse verfügbar oder sie hat nie existiert.</p>
	<p>Möchten Sie stattdessen auf unsere <a href="/" title="Startseite">Startseite</a> gehen?</p>
	<p>Wenn Sie der Meinung sind, dass dies ein Fehler von uns ist, können Sie uns gerne kontaktieren. Möglichkeiten zur Kontaktaufnahmen finden Sie im <a href="/impressum/#verantwortlich">Impressum</a>.</p>
</main>
<?php get_footer(); ?>