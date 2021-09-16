<?php

/**
 * Template Name: News-Übersicht
 * Jahres-Basierende Übersicht über alle News-Einträge
 */

/* Set News to current Menu Item */
add_filter('nav_menu_css_class', 'get_news_nav_class', 10, 2);

$currentYear = date('Y');
$requestedYear = get_the_date(_x('Y', 'yearly archives date format', 'phoenix'));

/*if($requestedYear == 2017) {
	header("HTTP/1.1 302 Found");
	header("Location: http://www.feuerwehr-aurachhöhe.de/news/2016");
	exit();
}*/

wp_enqueue_style('date', get_template_directory_uri() . '/date.css');
wp_enqueue_style('teaser', get_template_directory_uri() . '/css/teaser.css');

if (!is_year()) {
	global $wp_query;
	$wp_query->set_404();
	status_header(404);
	get_template_part(404);
	exit();
}

get_header();
?>
<main class="grey lighten-4">
	<div class="container">
		<ol class="flow-text breadcrumbs">
			<li>
				<a href="/news">
					News
				</a>
			</li>
			<li>
				<a href="/news/<?php echo $requestedYear; ?>">
					<?php echo $requestedYear; ?>
				</a>
			</li>
		</ol>
	</div>
	<div class="container">
		<?php
		// Print Previous and Next Buttons

		$years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts ORDER BY post_date DESC");
		$nextYear = current($years);
		while ($nextYear > $requestedYear) {
			$nextYear = next($years);
		}
		$nextYear = prev($years);
		$prevYear = end($years);
		while ($prevYear < $requestedYear) {
			$prevYear = prev($years);
		}
		$prevYear = next($years);
		if (have_posts()) {
			global $wp_query;
			query_posts(
				array_merge(
					$wp_query->query,
					array('posts_per_page' => -1)
				)
			);
		?>
			<div class="teaser-row">
				<?php
				$even = false;
				while (have_posts()) {
					the_post();
					$postClasses = array('teaser');
					if (!has_post_thumbnail()) {
						array_push($postClasses, 'no-featured-image');
					} ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class($postClasses); ?>>
						<header>
							<h1>
								<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
							</h1>
							<?php if (has_post_thumbnail()) { ?>
								<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail("medium_large"); ?></a>
							<?php } ?>
						</header>
						<?php the_excerpt(); ?>
						<footer>
							<?php
							// Translators: used between list items, there is a space after the comma.
							$categories_list = get_the_category_list(__(', ', 'twentytwelve'));

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
							if ($categories_list) {
								$utility_text = __('Dieser Beitrag wurde in %1$s am %3$s<span class="by-author"> von %4$s</span> veröffentlicht.', 'twentytwelve');
							} else {
								$utility_text = __('Dieser Beitrag wurde in %3$s<span class="by-author"> von %4$s</span> veröffentlicht.', 'twentytwelve');
							}

							printf(
								$utility_text,
								$categories_list,
								$date,
								$author
							);
							$posttags = get_the_tags();
							if ($posttags && count($posttags) > 0) {
								echo '<ul class="tags">';
								foreach ($posttags as $tag) {
									echo '<li><a href="' . esc_attr(get_tag_link($tag->term_id)) . '">' . $tag->name . '</a></li>';
								}
								echo '</ul>';
							}
							?>
						</footer>
					</article>
				<?php
				}
				?>
			</div>
			<p class="year-nav">
			<?php
			// Print Previous and Next Buttons again

			if ($requestedYear < $currentYear) {
				echo '<a href="/news/' . $nextYear . '" class="next waves-effect waves-light btn btn-large"><i class="material-icons left">keyboard_arrow_left</i>' . $nextYear . '</a>';
			}
			if ($requestedYear > end($years)) {
				echo '<a href="/news/' . $prevYear . '" class="prev waves-effect waves-light btn btn-large"><i class="material-icons right">keyboard_arrow_right</i>' . $prevYear . '</a>';
			}
		}
			?>
			</p>
	</div>
</main>
<?php get_footer(); ?>