<?php
/**
 * Template Name: News-Beitrag
 * Zeigt einen einzelnen Beitrag auf der News-Seite an.
 */

// Single Style
wp_enqueue_style('single', get_template_directory_uri().'/single.css' );
// Single Script
wp_enqueue_script( 'single', get_template_directory_uri() . '/single.js', array(), '0.0.1' );

/* Set News to current Menu Item */
add_filter( 'nav_menu_css_class', 'get_news_nav_class', 10, 2 );
wp_enqueue_style( 'sidebar', get_template_directory_uri() . '/style/sidebar.css' );

get_header();

$currentPost = get_post();
$creationDateObject = new DateTime($currentPost->post_date);
$creationYear = $creationDateObject->format('Y');

echo '<nav class="breadcrumbs">';
echo 'News &raquo; <a href="/news/'.$creationYear.'">'.$creationYear.'</a> &raquo; '.$currentPost->post_title;
echo '</nav>';
echo '<nav class="post-nav"><a href="/news/'.$creationYear.'" class="button">Alle Artikel aus '.$creationYear.'</a></nav>';
while ( have_posts() ) : the_post(); ?>
	<article>
		<header>
			<h1><?php the_title(); ?></h1>
			<?php $date = sprintf( '<time class="entry-date" datetime="%1$s">%2$s</time>',
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() )
			);
		echo $date; ?>
		</header>
		<?php if(!empty($currentPost->post_excerpt)) : ?>
	        <strong class="entry-summary">
		        <?php the_excerpt(); ?>
	        </strong>
		<?php endif; ?>
		<div><?php the_content(); ?></div>
	</article>
<?php endwhile;
echo "<div class=\"sidebar\">";
dynamic_sidebar("post-sidebar");
echo "</div>";
get_footer(); ?>
