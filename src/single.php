<?php
wp_enqueue_style('single', get_template_directory_uri() . '/single.css', array(), '0.0.4');
wp_enqueue_script('single', get_template_directory_uri() . '/single.js', array(), '0.0.5');
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
			</header>
			<?php if (!empty($currentPost->post_excerpt)) : ?>
				<strong>
					<?php the_excerpt(); ?>
				</strong>
			<?php endif; ?>
			<div><?php the_content(); ?></div>
			<footer>
				<?php the_tags(); ?>
				<p>
				<?php
					$author = sprintf(
						'<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author"><i class="material-icons">person</i>%3$s</a></span>',
						esc_url(get_author_posts_url(get_the_author_meta('ID'))),
						esc_attr(sprintf(__('View all posts by %s', 'twentytwelve'), get_the_author())),
						get_the_author()
					);

					$date = sprintf(
						'<a href="%1$s" title="%2$s" rel="bookmark"><i class="material-icons">event</i><time class="entry-date" datetime="%3$s">%4$s</time></a>',
						esc_url(get_permalink()),
						esc_attr(get_the_time()),
						esc_attr(get_the_date('c')),
						esc_html(get_the_date())
					);
				?>
				<?php echo $author; ?>
				<span><i class="material-icons">folder_open</i><?php echo get_the_category_list(', '); ?></span>
				<?php
					echo $date;
					if(is_user_logged_in() && shortcode_exists('wp-piwik')) {
						$hits = do_shortcode('[wp-piwik module="post" period="range" date="' . date('Y-m-d', get_post_timestamp()) . ',today" key="nb_hits"]');
						if(intval($hits) > 1) {
							?><span><i class="material-icons">visibility</i> <?php echo $hits; ?></span><?php
						}
					}
				?>
				</p>
			</footer>
		</article>
	</main>
<?php
endwhile;
get_footer(); ?>