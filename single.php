<?php get_header();

/* Set News to current Menu Item */
add_filter( 'nav_menu_css_class', 'get_news_nav_class', 10, 2 );

$currentPost = get_post();
$creationDateObject = new DateTime($currentPost->post_date);
$creationYear = $creationDateObject->format('Y');

echo '<nav class="breadcrumbs">';
echo 'News &raquo; '.$creationYear.' &raquo; '.$currentPost->post_title;
echo '</nav>';
echo '<nav class="post-nav"><a href="/news/'.$creationYear.'" class="button">Alle Artikel aus '.$creationYear.'</a></nav>';
		while ( have_posts() ) : the_post(); ?>
				<article>
					<header>
						<p><?php echo $creationDateObject->format('d.m.Y'); ?></p>
						<h1><?php the_title(); ?></h1>
					</header>
					<?php if(!empty($currentPost->post_excerpt)) : ?>
				        <strong class="entry-summary">
					        <?php the_excerpt(); ?>
				        </strong>
					<?php endif; ?>
					<div><?php the_content(); ?></div>
				</article>
			<?php endwhile; ?>
	<aside>
		<?php
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-3') ) :
		endif; ?>
	</aside>
	<div class="content-end"></div>
<?php get_footer(); ?>
