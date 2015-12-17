<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */


/* Set News to current Menu Item */
add_filter( 'nav_menu_css_class', 'get_news_nav_class', 10, 2 );

wp_enqueue_style( 'single', get_template_directory_uri() . '/css/single.css' );
wp_enqueue_script( 'news-single', get_template_directory_uri() . '/js/news-single.js', array(), '0.0.1' );

get_header();


$currentPost = get_post();
$creationDateObject = new DateTime($currentPost->post_date);
$creationYear = $creationDateObject->format('Y');

echo '<nav class="breadcrumbs">';
	echo 'News &raquo; '.$creationYear.' &raquo; '.$currentPost->post_title;
echo '</nav>';

?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<?php
			echo '<nav class="post-nav"><a href="/news/'.$creationYear.'" class="button">Alle Artikel aus '.$creationYear.'</a></nav>';
			while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>
					<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
					<div class="featured-post">
						<?php _e( 'Featured post', 'twentytwelve' ); ?>
					</div>
					<?php endif; ?>
				>	
					<header class="entry-header">
						<p class="single-date"><?php echo $creationDateObject->format('d.m.Y'); ?></p>
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<?php //the_post_thumbnail(); ?>
						<?php if ( comments_open() ) : ?>
							<div class="comments-link">
								<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'twentytwelve' ) . '</span>', __( '1 Reply', 'twentytwelve' ), __( '% Replies', 'twentytwelve' ) ); ?>
							</div><!-- .comments-link -->
						<?php endif; // comments_open() ?>
					</header><!-- .entry-header -->

					<?php if(!empty($currentPost->post_excerpt)) : ?>
					<strong class="entry-summary">
						<?php the_excerpt(); ?>
					</strong><!-- .entry-summary -->
					<?php endif; ?>
					<div class="entry-content">
						<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->
				</article><!-- #post -->

				
				
<?php /*
				<nav class="nav-single">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentytwelve' ) . '</span> %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentytwelve' ) . '</span>' ); ?></span>
				</nav><!-- .nav-single -->
*/ ?>
				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

	<div id="secondary" class="widget-area" role="complementary">
		<div class="first front-widgets">
			<?php
				if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-3') ) :
				endif; ?>
		</div><!-- .second -->
	</div>
	<div class="content-end"></div>
<?php get_footer(); ?>