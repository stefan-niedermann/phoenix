<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="alexaVerifyID" content="kMjLm19ma6RYSFrL64q0BqpR69Q" />
<meta name="google-site-verification" content="hlwlUyLCkDXJiGM7TY9K75ojiap0jIzzpguN-EyQ4XM" />
<meta name="rating" content="general" />
<meta name="geo.region" content="DE-BY" />
<meta name="geo.placename" content="Barthelmesaurach, 91126 Kammerstein, Deutschland" />
<meta name="geo.position" content="49.2798;10.9349" />
<meta name="ICBM" content="49.2798, 10.9349" />
<meta name="author" content="Stefan Niedermann" />
<meta name="application-name" content="FFW Barthelmesaurach e. V." />
<meta name="theme-color" content="#660000" />
<title><?php wp_title( '|', true, 'right' ); ?></title>

<link rel="shortcut icon" href="/favicon.ico"  type="image/x-icon"/>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<ul class="notification-bar">
	<!--[if IE]><li id="ie-warnung"><strong>Achtung:</strong> Sie verwenden einen veralteten, unsicheren Browser! Wir empfehlen den Einsatz von <strong><a href="https://www.mozilla.org/de/firefox/new/" title="Mozilla Firefox herunterladen">Mozilla Firefox</a></strong> oder <strong><a href="https://www.google.com/intl/de/chrome/browser/" title="Google Chrome herunterladen">Google Chrome</a></strong></li><![endif]-->
	<!--li>
		Aktuell kann die Website aufgrund von Wartungsarbeiten möglicherweise für einige Zeit schlecht erreichbar sein. Wir bitten um Ihr Verständnis.
	</li-->
</ul>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
		<img class="logo" alt="Logo der Freiwilligen Feuerwehr Barthelmesaurach" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" />
		<img class="wappen" alt="Wappen der Freiwilligen Feuerwehr Barthelmesaurach" src="<?php echo get_template_directory_uri(); ?>/img/wappen.png" />

		<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
		<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>

		<form role="search" method="get" id="searchform" class="searchform" action="http://www.feuerwehr-barthelmesaurach.de/">
			<fieldset>
				<input value="" name="s" id="s" type="search" placeholder="Suchbegriff eingeben...">
				<input id="searchsubmit" value="Suche" type="submit">
			</fieldset>
		</form>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		</nav><!-- #site-navigation -->

		<?php if ( get_header_image() ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?>
	</header><!-- #masthead -->

	<div id="main" class="wrapper">
