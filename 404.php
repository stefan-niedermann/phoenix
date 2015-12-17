<?php
/**
 * Template Name: 404
 * Handelt einen 404-Fehler
 */
wp_enqueue_style( 'sidebar', get_template_directory_uri() . '/style/sidebar.css' );
get_header(); ?>
<h1>Fehler 404</h1>
<p>Die gewünschte Seite konnte leider nicht gefunden werden.</p>
<p>Möchten Sie stattdessen auf unsere <a href="/" title="Startseite">Startseite</a> gehen?</p>
<?php get_footer(); ?>