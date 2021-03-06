<?php
wp_enqueue_style('404', get_template_directory_uri() . '/404.css');
wp_enqueue_style('cards', get_template_directory_uri() . '/css/cards.css');
wp_enqueue_style('tags', get_template_directory_uri() . '/css/tags.css');
get_header(); ?>
<main class="container flow-text">
	<h1 class="section center"><?php _e('Page not found', 'phoenix') ?></h1>
	<i class="material-icons">search</i>
	<p><?php _e('Oops, the page you are looking for could not be found. Either it is available on a new location or never existed.', 'phoenix'); ?></p>
	<p><?php printf(
		__('Do you want to go to the %1$s instead?', 'phoenix'),
		sprintf('<a href="%1$s">%2$s</a>', get_home_url(), __('homepage', 'phoenix'))
	); ?></p>
	<p><?php printf(
			__('If you think, that this is a mistake by us, you are welcome to get in touch with us. Contact options can be found on the %1$s page.', 'phoenix'),
			sprintf('<a href="%1$s">%2$s</a>', __('imprint url', 'phoenix'), __('imprint', 'phoenix'))
		); ?></p>
</main>
<section class="section grey lighten-4">
	<div class="container teaser-row">
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
</section>
<?php get_footer(); ?>