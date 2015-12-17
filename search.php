<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
wp_enqueue_style( 'search', get_template_directory_uri() . '/css/search.css' );
get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentytwelve' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header>

			<?php twentytwelve_content_nav( 'nav-above' ); ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post();
				$thumbnail = get_the_post_thumbnail(the_post()->ID, 'thumbnail');
				if(!empty($thumbnail)) {
					echo '<article class="with-thumbnail">';
				} else {
					echo '<article>';
				}
				echo $thumbnail;
				echo '<header class="entry-header"><h1><a href="';
				echo get_permalink();
				echo '">';
				the_title();
				echo '</a></h1>';
				$link = sprintf( '<a class="perma" href="%1$s" title="%2$s">%1$s</a>',
					esc_url( get_permalink() ),
					esc_attr( get_the_time() )
				);
				echo $link;
				echo '</header><div class="entry-content">';
				$date = sprintf( '<time class="entry-date" datetime="%1$s">%2$s</time>',
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() )
				);
				echo $date;
				the_excerpt();
				echo '</div></article>';
			endwhile;

			echo '<div class="content-end"></div>';

			?>

			<?php twentytwelve_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentytwelve' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>