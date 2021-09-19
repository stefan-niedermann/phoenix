<?php

/**
 * Template Name: News-Beitrag
 * Zeigt einen einzelnen Beitrag auf der News-Seite an.
 */

wp_enqueue_style('single', get_template_directory_uri() . '/single.css');
wp_enqueue_script('single', get_template_directory_uri() . '/single.js', array(), '0.0.1');
wp_enqueue_style('tags', get_template_directory_uri() . '/css/tags.css');

/* Set News to current Menu Item */
add_filter('nav_menu_css_class', 'get_news_nav_class', 10, 2);

get_header();

$currentPost = get_post();
$creationDateObject = new DateTime($currentPost->post_date);
$creationYear = $creationDateObject->format('Y');

while (have_posts()) : the_post();
	?>
	<main class="container flow-text">
		<ol class="breadcrumbs">
			<li><a href="/news"><?php _e('News'); ?></a></li>
			<li><a href="/news/<?php echo $creationYear; ?>"><?php echo $creationYear; ?></a></li>
			<li><a href="<?php echo get_permalink(); ?>"><?php echo $currentPost->post_title; ?></a></li>
		</ol>
		<article>
			<header>
				<h1><?php echo the_title(); ?></h1>
				<p class="grey-text">
					<?php the_author(); ?> - <time class="tooltipped" data-tooltip="<?php printf(
						__('Created on %1$s'),
						get_the_date("l, j. F Y, H:m")
					); ?>" datetime="<?php echo get_the_date( "c" ) ?>"><?php the_date(); ?></time>
					<?php
						if(is_user_logged_in()) {
							?>
                                <a href="<?php echo get_edit_post_link(get_the_ID()) ?>"
                                    style="color: inherit; margin-left: 1rem;"
                                    class="tooltipped"
                                    data-tooltip="<?php printf(
										__('Last edited on %1$s'),
										the_modified_date("l, j. F Y, H:m")
									) ?>">
								    <i class="material-icons">edit</i>
                                </a>
							<?php
						}
					?>
				</p>
				<?php the_tags(); ?>
			</header>
			<?php if (!empty($currentPost->post_excerpt)) : ?>
				<strong>
					<?php the_excerpt(); ?>
				</strong>
			<?php endif; ?>
			<div><?php the_content(); ?></div>
		</article>
	</main>
<?php
endwhile;
get_footer(); ?>