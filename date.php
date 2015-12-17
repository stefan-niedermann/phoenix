<?php
get_header();

/* Set News to current Menu Item */
add_filter( 'nav_menu_css_class', 'get_news_nav_class', 10, 2 );

$currentYear = date('Y');
$requestedYear = get_the_date( _x( 'Y', 'yearly archives date format', 'phoenix' ) );

if(!is_year()) {
	global $wp_query;
	$wp_query->set_404();
	status_header( 404 );
	get_template_part( 404 ); exit();
}

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
				if ($requestedYear < $currentYear) :
					echo '<a href="/news/'.$nextYear.'" class="button next">'.$nextYear.'</a>';
				endif;
				if ($requestedYear > end($years)) :
					echo '<a href="/news/'.$prevYear.'" class="button prev">'.$prevYear.'</a>';
				endif;
			?>
		</header>
		<?php if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			global $wp_query;
			query_posts(
				array_merge(
					$wp_query->query,
					array('posts_per_page' => -1)
				)
			);
			while ( have_posts() ) : the_post();
?>

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
		<footer class="entry-meta">
			<?php twentytwelve_entry_meta(); ?>
			<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
				<div class="author-info">
					<div ">
						<?php
						/** This filter is documented in author.php */
						$author_bio_avatar_size = apply_filters( 'twentytwelve_author_bio_avatar_size', 68 );
						echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
						?>
					</div>
					<div class="author-description">
						<h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
						<p><?php the_author_meta( 'description' ); ?></p>
						<div class="author-link">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentytwelve' ), get_the_author() ); ?>
							</a>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</footer>
	</article>
		<?php
			endwhile;

			// Print Previous and Next Buttons again

			if ($requestedYear < $currentYear) :
				echo '<a href="/news/'.$nextYear.'" class="next button">'.$nextYear.'</a>';
			endif;
			if ($requestedYear > end($years)) :
				echo '<a href="/news/'.$prevYear.'" class="prev button">'.$prevYear.'</a>';
			endif;
		?>
	</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
