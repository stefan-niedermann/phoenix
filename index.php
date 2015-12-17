<?php
/**
 * Template Name: Fallback
 * Generisches Template für eine Seite, der kein Template zugewiesen ist
 */
get_header(); ?>
<?php if ( have_posts() ) { ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</article>

		<?php //if (comments_open() && have_comments() ) {
			comment_form();  ?>
			<ol class="commentlist">
				<?php comments_template(); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below" class="navigation" role="navigation">
				<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'twentytwelve' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentytwelve' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentytwelve' ) ); ?></div>
			</nav>
			<?php endif;
		//}
	endwhile;
}
get_footer();
?>
