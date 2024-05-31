<?php
/* Set News to current Menu Item */
add_filter('nav_menu_css_class', 'get_news_nav_class', 10, 2);

$currentYear = date('Y');
$requestedYear = get_the_date(_x('Y', 'yearly archives date format', 'phoenix'));

/*if($requestedYear == 2017) {
	header("HTTP/1.1 302 Found");
	header("Location: http://www.feuerwehr-aurachhoehe.de/news/2016");
	exit();
}*/

wp_enqueue_style('date', get_template_directory_uri() . '/date.css');
wp_enqueue_style('cards', get_template_directory_uri() . '/css/cards.css');
wp_enqueue_style('tags', get_template_directory_uri() . '/css/tags.css');

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
			<li><a href="/news"><?php _e('News', 'phoenix'); ?></a></li>
			<li><a href="/news/<?php echo $requestedYear; ?>"><?php echo $requestedYear; ?></a></li>
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
					the_teaser_entry(array('col', 'l6'));
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