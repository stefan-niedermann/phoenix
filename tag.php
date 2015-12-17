<?php
/**
 * The template for displaying Tag pages
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

wp_enqueue_style( 'tag', get_template_directory_uri() . '/css/tag.css' );
get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Tag Archives: %s', 'twentytwelve' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>

			<?php if ( tag_description() ) : // Show an optional tag description ?>
				<div class="archive-meta"><?php echo tag_description(); ?></div>
			<?php endif; ?>
			</header><!-- .archive-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
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
			twentytwelve_content_nav( 'nav-below' );
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>