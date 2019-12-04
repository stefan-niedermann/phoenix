<?php
/**
 * Template Name: Fallback
 * Generisches Template für eine Seite, der kein Template zugewiesen ist
 */
get_header(); ?>
<main class="container flow-text">
<?php if ( have_posts() ) { ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php the_content(); ?>
		</article>

		<?php if (comments_open()) {
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
		}
	endwhile;
}
?>
</main>
<?php /*
$currentPost = get_post();
$customValues = get_post_custom_values("Post Teaser Kategorie", $currentPost->ID);
if(count($customValues) > 0) {
	echo '<div style="display: none;">';
	$teaserquery = new WP_Query(array(
		'posts_per_page' => 2,
		'post_type' => 'post',
		'post_status' => 'publish',
		'cat' => $customValues[0]
	));
	while ( $teaserquery->have_posts() ) {
		$teaserquery->the_post();
		?>
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
		<?php
	}
	echo '</div>';
}*/
get_footer();
?>
