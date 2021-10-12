<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">

<head>
	<title><?php if(!is_front_page()) { wp_title("-", true, "right"); } ?> <?php bloginfo('name') ?></title>
	<meta content="<?php bloginfo('name');  ?>" />
	<meta charset="<?php bloginfo("charset"); ?>" />
	<meta name="viewport" content="width=device-width" />
	<meta name="theme-color" content="#440000" />
	<meta property="og:site_name" content="<?php bloginfo('name');  ?>" />
	<meta property="og:title" content="<?php echo wp_title("-", true, "right");  ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?php echo get_site_url(); ?>" />
	<?php
	$og_image_url = get_the_post_thumbnail_url();
	if (empty($og_image_url)) {
		// TODO remove hard coded string, maybe we can get the featured image of the homepage?
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
	wp_enqueue_style('materialize-css', get_template_directory_uri() . '/css/materialize.min.css', array(), '1.1.0');
	wp_enqueue_style('main', get_template_directory_uri() . '/style.css', array(), '3.2.0');
	wp_enqueue_script('materialize-js', get_template_directory_uri() . '/js/materialize.min.js', array(), '1.1.0');
	wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array(), '3.2.2');
	?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="navbar-fixed">
		<nav>
			<div class="nav-wrapper">
				<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
				<a class="hide-on-large-only" href="/"><?php bloginfo("name") ?></a>
				<?php wp_nav_menu(array(
					"theme_location" => "header-menu",
					"menu_class" => "container center hide-on-med-and-down",
					"menu_id" => "nav-mobile",
					"container" => null
				)); ?>
			</div>
		</nav>
	</div>
	<ul id="slide-out" class="sidenav show-on-small">
    	<li>
			<div class="user-view">
				<img class="circle" src="<?php echo get_template_directory_uri(); ?>/img/logo.svg">
				<span class="white-text name"><?php bloginfo("name") ?></span>
				<span class="white-text email"><?php bloginfo("description") ?></span>
    		</div>
		</li>
		<?php wp_nav_menu(array(
			"theme_location" => "header-menu",
			"container" => null,
			"items_wrap" => '%3$s'
		)); ?>
		<li><div class="divider"></div></li>
		<?php wp_nav_menu(array(
			"theme_location" => "footer-menu",
			"container" => null,
			"items_wrap" => '%3$s'
		)); ?>
	</ul>