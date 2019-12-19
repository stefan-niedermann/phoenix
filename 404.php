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
			// do stuff
		?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(array('teaser col l6')); ?>>
				<header>
					<h1>
						<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h1>
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail("medium_large"); ?></a>
				</header>
				<div class="flow-text">
					<?php the_excerpt(); ?>
				</div>
				<footer>
					<?php
																			// Translators: used between list items, there is a space after the comma.
																			$categories_list = get_the_category_list(__(', ', 'twentytwelve'));

																			// Translators: used between list items, there is a space after the comma.
																			$tag_list = get_the_tag_list('', __(', ', 'twentytwelve'));

																			$date = sprintf(
																				'<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
																				esc_url(get_permalink()),
																				esc_attr(get_the_time()),
																				esc_attr(get_the_date('c')),
																				esc_html(get_the_date())
																			);

																			$author = sprintf(
																				'<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
																				esc_url(get_author_posts_url(get_the_author_meta('ID'))),
																				esc_attr(sprintf(__('View all posts by %s', 'twentytwelve'), get_the_author())),
																				get_the_author()
																			);

																			// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
																			if ($tag_list) {
																				$utility_text = __('Dieser Beitrag wurde in %1$s am %3$s<span class="by-author"> von %4$s</span> veröffentlicht. Schlagworte: %2$s', 'twentytwelve');
																			} elseif ($categories_list) {
																				$utility_text = __('Dieser Beitrag wurde in %1$s am %3$s<span class="by-author"> von %4$s</span> veröffentlicht.', 'twentytwelve');
																			} else {
																				$utility_text = __('Dieser Beitrag wurde in %3$s<span class="by-author"> von %4$s</span> veröffentlicht.', 'twentytwelve');
																			}

																			printf(
																				$utility_text,
																				$categories_list,
																				$tag_list,
																				$date,
																				$author
																			);
					?>
				</footer>
			</article>
		<?php
																		}
																		wp_reset_postdata();
		?>
	</div>
</section>
<?php get_footer(); ?>