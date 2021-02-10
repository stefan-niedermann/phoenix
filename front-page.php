<?php

/**
 * Template Name: Startseite
 * Kommt auf der Startseite zum Einsatz
 */
wp_enqueue_style('sidebar', get_template_directory_uri() . '/sidebar.css');
wp_enqueue_style('date',    get_template_directory_uri() . '/front-page.css');
wp_enqueue_style('teaser',  get_template_directory_uri() . '/css/teaser.css');
get_header();
?>
<header class="section white-text" style="background-image: url(<?php the_post_thumbnail_url(array(1920));  ?>)">
	<div>
		<div class="container">
			<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Retten, Löschen, Schützen, Bergen">
			<div class="hgroup">
				<h1><?php bloginfo("name"); ?></h1>
				<h2><?php bloginfo("description"); ?></h2>
			</div>
		</div>
	</div>
</header>
<section class="section grey lighten-4">
	<div class="container sidebar">
		<ul class="collapsible">
			<?php dynamic_sidebar("main-sidebar"); ?>
		</ul>
	</div>
</section>
<main class="section container flow-text">
	<?php if (have_posts()) { ?>
		<?php while (have_posts()) {
																		the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</article>
	<?php }
																} ?>
</main>
<section class="section grey lighten-4">
	<div class="container">
		<div class="teaser-row">
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
					<?php the_excerpt(); ?>
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
	</div>
</section>
<?php get_footer(); ?>