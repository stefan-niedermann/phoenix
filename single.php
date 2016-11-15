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
wp_enqueue_style( 'sidebar', get_template_directory_uri() . '/sidebar.css' );

get_header();

$currentPost = get_post();
$creationDateObject = new DateTime($currentPost->post_date);
$creationYear = $creationDateObject->format('Y');

?>
<main>
<nav class="breadcrumbs">
	<ol itemscope="itemscope" itemtype="http://schema.org/BreadcrumbList">
		<li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
			<a href="/news" itemprop="item">
				<span itemprop="name">News</span>
				<meta itemprop="position" content="1" />
			</a>
		</li>
		<li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
			<a href="/news/<?php echo $creationYear; ?>" itemprop="item">
				<span itemprop="name"><?php echo $creationYear; ?></span>
				<meta itemprop="position" content="2" />
			</a>
		</li>
		<li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
			<a href="<?php echo get_permalink(); ?>" itemprop="item">
				<span itemprop="name"><?php echo $currentPost->post_title; ?></span>
				<meta itemprop="position" content="3" />
			</a>
		</li>
	</ol>
</nav>
<nav class="post-nav">
	<a href="/news/<?php echo $creationYear; ?>" class="button">Alle Artikel aus <?php echo $creationYear; ?></a>
</nav>
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
<?php endwhile;
echo "<div class=\"sidebar\">";
dynamic_sidebar("post-sidebar");
echo "</div>";
?>
</main>
<?php
get_footer(); ?>
