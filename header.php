<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9]><html class="ie ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( "charset" ); ?>" />
	<title><?php wp_title( "|", true, "right" ); ?></title>
	<meta name="viewport" content="width=device-width" />
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png"  type="image/png" />
	<link rel="pingback" href="<?php bloginfo( "pingback_url" ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="wrapper" id="top">
	<header>
		<img class="logo" alt="Logo" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" />
		<img class="wappen" alt="Wappen" src="<?php echo get_template_directory_uri(); ?>/img/wappen.png" />
		<h1><?php bloginfo( "name" ); ?></h1>
		<h2><?php bloginfo( "description" ); ?></h2>
		<form role="search" method="get" id="searchform" class="searchform" action="http://www.feuerwehr-barthelmesaurach.de/">
			<fieldset>
				<input id="s" name="s" type="search" placeholder="Suchbegriff eingeben...">
				<input id="searchsubmit" value="Suche" type="submit">
			</fieldset>
		</form>
		<nav>
			<?php wp_nav_menu( array( "theme_location" => "primary", "menu_class" => "nav-menu" ) ); ?>
		</nav>
	</header>
	<main>
