<?php
/**
 * Template Name: Header
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php wp_title( "|", true, "right" ); ?></title>
	<meta name="viewport" content="width=device-width" />
	<meta name="theme-color" content="#660000" />
	<meta charset="<?php bloginfo( "charset" ); ?>" />
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png"  type="image/png" />
	<link rel="pingback" href="<?php bloginfo( "pingback_url" ); ?>" />
	<?php
		// Normalizer and Stylesheets
		wp_enqueue_style('normalize', get_template_directory_uri().'/style/normalize-3.0.2.css', array(), '3.0.0' );
		wp_enqueue_style('style', get_template_directory_uri().'/style.css' );
	?>
	<!--[IF !IE]> --><script type="text/javascript" src="<?php echo get_template_directory_uri() . '/script/script.js'; ?>"></script><!-- <![ENDIF]-->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="wrapper" id="top">
	<header>
		<img class="logo" alt="Logo" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" />
		<img class="wappen" alt="Wappen" src="<?php echo get_template_directory_uri(); ?>/img/wappen.png" />
		<h1><?php bloginfo( "name" ); ?></h1>
		<h2><?php bloginfo( "description" ); ?></h2>
		<form role="search" method="get" id="searchform" class="searchform" action="/">
			<fieldset>
				<input id="s" name="s" type="search" placeholder="Suchbegriff eingeben..." autocomplete="off">
				<button type="submit">Suche</button>
			</fieldset>
		</form>
	</header>
	<nav id="site-navigation">
		<?php wp_nav_menu( array( "theme_location" => "header-menu" ) ); ?>
	</nav>
	<div class="content-container">
		<main>
