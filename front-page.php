<?php

/**
 * Template Name: Startseite
 * Kommt auf der Startseite zum Einsatz
 */
wp_enqueue_style('sidebar', get_template_directory_uri() . '/sidebar.css');
wp_enqueue_style('date',    get_template_directory_uri() . '/front-page.css');
wp_enqueue_style('teaser',  get_template_directory_uri() . '/css/teaser.css');
get_header(); ?>
<header class="section white-text">
	<div class="container">
		<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Retten, Löschen, Schützen, Bergen">
		<div class="hgroup">
			<h1><?php bloginfo("name"); ?></h1>
			<h2><?php bloginfo("description"); ?></h2>
		</div>
	</div>
</header>
<section class="section">
	<div class="container sidebar">
		<div class="row">
			<?php dynamic_sidebar("main-sidebar"); ?>
			<div class="col s12 m4">
				<h2>Termine</h2>
				<div class="textwidget">
					<ul>
						<li>6. Januar, 14:00 Uhr<br>
							<strong>JHV</strong> Barthelmesaurach im Gasthaus Gundel</li>
						<li>15. Februar, 21:00 Uhr<br>
							<strong>JHV</strong> Günzersreuth im Gasthaus Ziegler</li>
						<li>9. Mai, 19:00 Uhr<br>
							<strong>Grillfest</strong> am Feuerwehrhaus</li>
						<li>28. November, 19:00 Uhr<br>
							<strong>Weihnachtsfeier</strong></li>
					</ul>
				</div>
			</div>
			<div class="col s12 m4">
				<h2>Übungspläne</h2>
				<div class="textwidget">
					<ul class="uebungsplaene">
						<li><a href="/wp-content/uploads/2019/03/Übungsplan-2019.pdf">Aktive ( &gt; 18)</a></li>
						<li><a href="https://www.feuerwehr-aurachhöhe.de/wp-content/uploads/2019/01/Übungsplan-2019.pdf">Jugend (12 – 18)</a></li>
						<li><a href="https://www.feuerwehr-aurachhöhe.de/wp-content/uploads/2019/01/Uebungsplan_Bambini.pdf">Bambini (6 – 12)</a></li>
					</ul>
				</div>
			</div>
			<div class="col s12 m4">
				<h2>Dokumente</h2>
				<div class="textwidget">
					<ul>
						<li><a href="/wp-content/uploads/2015/11/Aufnahmeantrag-mit-Einzugsermächtigung.pdf" title="Aufnahmeantrag herunterladen">Aufnahmeantrag FFW Barthelmesaurach e. V.</a></li>
						<li><a href="/wp-content/uploads/2017/03/Satzung-der-Freiwilligen-Feuerwehr-Barthelmesaurach-e.-V.-2016.pdf">Satzung FFW Barthelmesaurach e. V.</a></li>
						<li><a href="/wp-content/uploads/2017/03/FF-Günzersreuth-Aufnahmeantrag-2017.pdf">Aufnahmeantrag FFW Günzersreuth e. V.</a></li>
					</ul>
				</div>
			</div>
		</div>
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
	<div class="sidebar">
		<?php dynamic_sidebar("main-sidebar"); ?>
	</div>
</main>
<section class="section">
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
	</div>
</section>
<?php get_footer(); ?>