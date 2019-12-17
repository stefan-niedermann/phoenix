<?php

/**
 * Template Name: News-Beitrag
 * Zeigt einen einzelnen Beitrag auf der News-Seite an.
 */

wp_enqueue_style('single', get_template_directory_uri() . '/single.css');
wp_enqueue_script('single', get_template_directory_uri() . '/single.js', array(), '0.0.1');

/* Set News to current Menu Item */
add_filter('nav_menu_css_class', 'get_news_nav_class', 10, 2);
wp_enqueue_style('sidebar', get_template_directory_uri() . '/sidebar.css');

get_header();

$currentPost = get_post();
$creationDateObject = new DateTime($currentPost->post_date);
$creationYear = $creationDateObject->format('Y');

while (have_posts()) : the_post();
	?>
	<main class="container flow-text">
		<ol class="breadcrumbs">
			<li>
				<a href="/news">
					<span>News</span>
				</a>
			</li>
			<li>
				<a href="/news/<?php echo $creationYear; ?>">
					<span><?php echo $creationYear; ?></span>
				</a>
			</li>
			<li>
				<a href="<?php echo get_permalink(); ?>">
					<span><?php echo $currentPost->post_title; ?></span>
				</a>
			</li>
		</ol>
		<article>
			<header>
				<h1><?php echo the_title(); ?></h1>
				<p class="grey-text"><?php the_author(); ?> - <?php the_date(); ?></p>
			</header>
			<?php if (!empty($currentPost->post_excerpt)) : ?>
				<strong class="white-text">
					<?php the_excerpt(); ?>
				</strong>
			<?php endif; ?>
			<div><?php the_content(); ?></div>
		</article>
	</main>
	<section class="sidebar">
		<?php dynamic_sidebar("post-sidebar"); ?>
	</section>
<?php
endwhile;
get_footer(); ?>