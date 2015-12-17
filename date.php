<?php
/**
 * Template Name: News-Übersicht
 * Jahres-Basierende Übersicht über alle News-Einträge
 */

/* Set News to current Menu Item */
add_filter( 'nav_menu_css_class', 'get_news_nav_class', 10, 2 );

$currentYear = date('Y');
$requestedYear = get_the_date( _x( 'Y', 'yearly archives date format', 'phoenix' ) );

wp_enqueue_style( 'date', get_template_directory_uri() . '/date.css' );

if(!is_year()) {
	global $wp_query;
	$wp_query->set_404();
	status_header( 404 );
	get_template_part( 404 ); exit();
}

get_header();

echo '<nav class="breadcrumbs">';
echo 'News » '.$requestedYear;
echo '</nav>';
?>
	<section>
		<header>
			<?php
				// Print Previous and Next Buttons

				$years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts ORDER BY post_date DESC");
				$nextYear = current($years);
				while($nextYear > $requestedYear) {
					$nextYear = next($years);
				}
				$nextYear = prev($years);
				$prevYear = end($years);
				while($prevYear < $requestedYear) {
					$prevYear = prev($years);
				}
				$prevYear = next($years);
				if ($requestedYear < $currentYear) {
					echo '<a href="/news/'.$nextYear.'" class="button next">'.$nextYear.'</a>';
				}
				if ($requestedYear > end($years)) {
					echo '<a href="/news/'.$prevYear.'" class="button prev">'.$prevYear.'</a>';
				}
			?>
		</header>
		<?php if ( have_posts() ) {
			global $wp_query;
			query_posts(
				array_merge(
					$wp_query->query,
					array('posts_per_page' => -1)
				)
			);
		?>
		<div class="articles">
			<?php while ( have_posts() ) { the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header>
					<h1>
						<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h1>
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail(); ?></a>
				</header>
				<div>
					<?php the_excerpt(); ?>
				</div>
				<footer>
					<?php
						// Translators: used between list items, there is a space after the comma.
						$categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );

						// Translators: used between list items, there is a space after the comma.
						$tag_list = get_the_tag_list( '', __( ', ', 'twentytwelve' ) );

						$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
							esc_url( get_permalink() ),
							esc_attr( get_the_time() ),
							esc_attr( get_the_date( 'c' ) ),
							esc_html( get_the_date() )
						);

						$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
							esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
							esc_attr( sprintf( __( 'View all posts by %s', 'twentytwelve' ), get_the_author() ) ),
							get_the_author()
						);

						// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
						if ( $tag_list ) {
							$utility_text = __( 'Dieser Beitrag wurde in %1$s am %3$s<span class="by-author"> von %4$s</span> veröffentlicht. Schlagworte: %2$s', 'twentytwelve' );
						} elseif ( $categories_list ) {
							$utility_text = __( 'Dieser Beitrag wurde in %1$s am %3$s<span class="by-author"> von %4$s</span> veröffentlicht.', 'twentytwelve' );
						} else {
							$utility_text = __( 'Dieser Beitrag wurde in %3$s<span class="by-author"> von %4$s</span> veröffentlicht.', 'twentytwelve' );
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
			<?php } ?>
		</div>
		<footer>
		<?php
			// Print Previous and Next Buttons again

			if ($requestedYear < $currentYear) {
				echo '<a href="/news/'.$nextYear.'" class="next button">'.$nextYear.'</a>';
			}
			if ($requestedYear > end($years)) {
				echo '<a href="/news/'.$prevYear.'" class="prev button">'.$prevYear.'</a>';
			}
		}
		?>
		</footer>
	</section>
<?php get_footer(); ?>