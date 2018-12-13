<?php
/**
 * Template Name: Event-Beitrag
 * Zeigt einen einzelnen Beitrag auf der News-Seite an.
 */

// Single Style
wp_enqueue_style('single', get_template_directory_uri().'/single.css' );
// Single Script
wp_enqueue_script( 'single', get_template_directory_uri() . '/single.js', array(), '0.0.1' );

/* Set News to current Menu Item */
//add_filter( 'nav_menu_css_class', 'get_news_nav_class', 10, 2 );
//wp_enqueue_style( 'sidebar', get_template_directory_uri() . '/sidebar.css' );

get_header();

$currentPost = get_post();
$creationDateObject = new DateTime($currentPost->post_date);
$creationYear = $creationDateObject->format('Y');

?>
<main>
<!--nav class="breadcrumbs">
	<ol>
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
</nav-->
<!--nav class="post-nav">
	<a href="/news/<?php echo $creationYear; ?>" class="button">Alle Veranstaltungen aus <?php echo $creationYear; ?></a>
</nav-->
<?php
while ( have_posts() ) : the_post(); ?>
	<article>
		<header>
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
</main>
<?php
get_footer(); ?>
