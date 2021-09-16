<?php

/**
 * Template Name: Startseite
 * Kommt auf der Startseite zum Einsatz
 */
wp_enqueue_style('sidebar', get_template_directory_uri() . '/sidebar.css');
wp_enqueue_style('date',    get_template_directory_uri() . '/front-page.css');
wp_enqueue_style('teaser',  get_template_directory_uri() . '/css/teaser.css');
get_header();
?>
<header class="section white-text" style="background-image: url(<?php the_post_thumbnail_url(array(1920));  ?>)">
	<div>
		<div class="container">
			<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Retten, Löschen, Schützen, Bergen">
			<div class="hgroup">
				<h1><?php bloginfo("name"); ?></h1>
				<h2><?php bloginfo("description"); ?></h2>
			</div>
		</div>
	</div>
</header>
<section class="section grey lighten-4">
	<div class="container sidebar">
		<ul class="collapsible">
			<?php dynamic_sidebar("main-sidebar"); ?>
		</ul>
	</div>
</section>
<main class="section container flow-text">
	<?php if (have_posts()) { ?>
		<?php while (have_posts()) {
			the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</article>
	<?php }
	} ?>
</main>
<section class="section grey lighten-4">
	<div class="container">
		<div class="teaser-row">
			<?php
			$teaserquery = new WP_Query(array(
				'posts_per_page' => 2,
				'post_type' => 'post',
				'post_status' => 'publish'
			));
			while ($teaserquery->have_posts()) {
				$teaserquery->the_post();
				the_teaser_entry(array('col', 'l6'));
			}
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>
<?php get_footer(); ?>