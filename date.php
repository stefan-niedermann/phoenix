<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Twelve already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

$currentYear = date('Y');
$requestedYear = get_the_date( _x( 'Y', 'yearly archives date format', 'phoenix' ) );

if(!is_year()) {
	global $wp_query;
	$wp_query->set_404();
	status_header( 404 );
	get_template_part( 404 ); exit();
}

/* Set News to current Menu Item */
add_filter( 'nav_menu_css_class', 'get_news_nav_class', 10, 2 );

wp_enqueue_script( 'news-archive', get_template_directory_uri() . '/js/news-archive.js' );
wp_enqueue_style( 'archive', get_template_directory_uri() . '/css/archive.css' );

get_header();

echo '<nav class="breadcrumbs">';
	echo 'News &raquo; '.$requestedYear;
echo '</nav>';
?>

	<section id="primary" class="site-content">
		<header class="archive-header">
			<?php
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
					echo '<a href="/news/'.$nextYear.'" class="next button">'.$nextYear.'</a>';
				endif;
				if ($requestedYear > end($years)) :
					echo '<a href="/news/'.$prevYear.'" class="prev button">'.$prevYear.'</a>';
				endif;
			?>
		</header><!-- .archive-header -->
		<div id="content" role="main" class="news-page">

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

				/* Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail(); ?></a>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				the_excerpt();
				//the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) );
			//wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">
			<?php twentytwelve_entry_meta(); ?>
			<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
				<div class="author-info">
					<div class="author-avatar">
						<?php
						/** This filter is documented in author.php */
						$author_bio_avatar_size = apply_filters( 'twentytwelve_author_bio_avatar_size', 68 );
						echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
						?>
					</div><!-- .author-avatar -->
					<div class="author-description">
						<h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
						<p><?php the_author_meta( 'description' ); ?></p>
						<div class="author-link">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentytwelve' ), get_the_author() ); ?>
							</a>
						</div><!-- .author-link	-->
					</div><!-- .author-description -->
				</div><!-- .author-info -->
			<?php endif; ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
<?php
			endwhile;

			twentytwelve_content_nav( 'nav-below' );
					echo '<div class="content-end"></div>';
					if ($requestedYear < $currentYear) :
						echo '<a href="/news/'.$nextYear.'" class="next button">'.$nextYear.'</a>';
					endif;
					if ($requestedYear > end($years)) :
						echo '<a href="/news/'.$prevYear.'" class="prev button">'.$prevYear.'</a>';
					endif;
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<div class="content-end"></div>
<?php get_footer(); ?>