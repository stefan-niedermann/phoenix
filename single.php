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
				<p class="grey-text">
					<?php the_author(); ?> - <time class="tooltipped" data-tooltip="Erstellt am <?php echo get_the_date("l, j. F Y, H:m") ?> Uhr" datetime="<?php echo get_the_date( "c" ) ?>"><?php the_date(); ?></time>
					<?php
						$creationDateObject = new DateTime($currentPost->post_date);
						$modifiedDateObject = new DateTime($currentPost->post_modified);
						if($modifiedDateObject > $creationDateObject) {
							?>
								<time class="tooltipped" data-tooltip="Zuletzt bearbeitet am <?php the_modified_date("l, j. F Y, H:m") ?> Uhr" datetime="<?php the_modified_date("j. M. Y H:i") ?>">
									<i class="material-icons">edit</i>
								</time>
							<?php
						}
					?>
				</p>
			</header>
			<?php if (!empty($currentPost->post_excerpt)) : ?>
				<strong class="white-text">
					<?php the_excerpt(); ?>
				</strong>
			<?php endif; ?>
			<div><?php the_content(); ?></div>
		</article>
	</main>
<?php
endwhile;
get_footer(); ?>