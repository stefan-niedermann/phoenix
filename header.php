<?php

/**
 * Template Name: Header
 */
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">

<head>
	<title><?php wp_title("|", true, "right"); ?></title>
	<meta content="<?php bloginfo('name');  ?>" />
	<meta charset="<?php bloginfo("charset"); ?>" />
	<meta name="viewport" content="width=device-width" />
	<meta name="theme-color" content="#440000" />
	<meta property="og:site_name" content="<?php bloginfo('name');  ?>" />
	<meta property="og:title" content="<?php echo wp_title("|", true, "right");  ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?php echo get_site_url(); ?>" />
	<?php
	$og_image_url = get_the_post_thumbnail_url();
	if (empty($og_image_url)) {
		$og_image_url = 'https://www.feuerwehr-aurachhöhe.de/wp-content/uploads/2016/08/apple-touch-icon-180x180.png';
	}
	?>
	<meta property="og:image" content="<?php echo $og_image_url ?>" />
	<?php
	$og_excerpt = get_the_excerpt();
	if (!empty($og_excerpt) && (strpos($og_excerpt, "<") === false)) { ?>
		<meta property="og:description" content="<?php echo $og_excerpt ?>" />
	<?php } ?>
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png" type="image/png" />
	<link rel="pingback" href="<?php bloginfo("pingback_url"); ?>" />
	<?php
	// Normalizer and Stylesheets
	wp_enqueue_style('materialize-css', get_template_directory_uri() . '/css/materialize-1.0.0.min.css', array(), '1.0.0');
	wp_enqueue_style('main', get_template_directory_uri() . '/style.css');
	wp_enqueue_script('materialize-js', get_template_directory_uri() . '/js/materialize-1.0.0.min.js', array(), '1.0.0');
	wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js');
	?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="navbar-fixed">
		<nav>
			<div class="nav-wrapper">
				<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
				<?php wp_nav_menu(array(
					"theme_location" => "header-menu",
					"menu_class" => "container center hide-on-med-and-down",
					"menu_id" => "nav-mobile",
					"container" => null
				)); ?>
			</div>
		</nav>
	</div>
	<?php wp_nav_menu(array(
		"theme_location" => "header-menu",
		"menu_class" => "sidenav show-on-small",
		"menu_id" => "slide-out",
		"container" => null
	)); ?>