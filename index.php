<?php
/**
 * Template Name: Fallback
 * Generisches Template für eine Seite, der kein Template zugewiesen ist
 */
wp_enqueue_style('index', get_template_directory_uri() . '/index.css');

$currentPost = get_post();
$customValues = get_post_custom_values("Post Teaser Kategorie", $currentPost->ID);

if(!empty($customValues) && count($customValues) > 0) {
	wp_enqueue_style('cards', get_template_directory_uri() . '/css/cards.css');
	wp_enqueue_style('tags', get_template_directory_uri() . '/css/tags.css');
}

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
<?php
	if(!empty($customValues) && count($customValues) > 0) {
		$category = get_category_by_slug($customValues[0]);
		if($category) { ?>
			<section class="section grey lighten-4 trivia">
				<div class="container teaser-row">
				<?php
					$teaserquery = new WP_Query(array(
						'posts_per_page' => 4,
						'post_type' => 'post',
						'post_status' => 'publish',
						'cat' => $category->term_id
					));
					while ( $teaserquery->have_posts() ) {
						$teaserquery->the_post();
						the_teaser_entry(array('col', 'l6'));
					}
					wp_reset_postdata();
				?>
				<a href="<?php get_category_link($category) ?>" class="btn btn-large waves-effect waves-light">Weitere Artikel</a>
				</div>
			</section>
			<?php
		}
	}
	get_footer();
?>
