<?php
/**
 * Template Name: News-Übersicht
 * Jahres-Basierende Übersicht über alle News-Einträge
 */

/* Set News to current Menu Item */
add_filter( 'nav_menu_css_class', 'get_news_nav_class', 10, 2 );

$currentYear = date('Y');
$requestedYear = get_the_date( _x( 'Y', 'yearly archives date format', 'phoenix' ) );

/*if($requestedYear == 2017) {
	header("HTTP/1.1 302 Found");
	header("Location: http://www.feuerwehr-aurachhöhe.de/news/2016");
	exit();
}*/

wp_enqueue_style( 'date', get_template_directory_uri() . '/date.css' );
// wp_enqueue_script( 'masonry.pkgd.min', get_template_directory_uri() . '/script/masonry.pkgd.min.js', array(), '0.0.1' );
//  data-masonry='{ "itemSelector": "post", "fitWidth": true; "columnWidth": "article"; "gutter": "article" }'

if(!is_year()) {
	global $wp_query;
	$wp_query->set_404();
	status_header( 404 );
	get_template_part( 404 ); exit();
}

get_header();
?>
<main>
	<nav class="breadcrumbs">
		<ol itemscope="itemscope" itemtype="http://schema.org/BreadcrumbList">
			<li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
				<a href="/news" itemprop="item">
					<span itemprop="name">News</span>
					<meta itemprop="position" content="1" />
				</a>
			</li>
			<li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
				<a href="/news/<?php echo $requestedYear; ?>" itemprop="item">
					<span itemprop="name"><?php echo $requestedYear; ?></span>
					<meta itemprop="position" content="2" />
				</a>
			</li>
		</ol>
	</nav>
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
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail("medium_large"); ?></a>
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
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<ins class="adsbygoogle"
			     style="display:block; margin-bottom: 1em;border-radius: 2px; box-shadow: 2px 3px 3px rgb(204, 204, 204);"
			     data-ad-format="fluid"
			     data-ad-layout-key="-7c+2j-iw+al+16i"
			     data-ad-client="ca-pub-3162933551127981"
			     data-ad-slot="2647871655"></ins>
			<script>
			     (adsbygoogle = window.adsbygoogle || []).push({});
			</script>
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
</main>
<?php get_footer(); ?>
