<?php
/**
 * Template Name: Header
 */
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
<head>
	<title><?php wp_title( "|", true, "right" ); ?></title>
	<meta content="<?php echo get_bloginfo( 'name' );  ?>" />
	<meta charset="<?php bloginfo( "charset" ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<meta name="theme-color" content="#440000" />
    <meta property="og:site_name" content="<?php echo get_bloginfo( 'name' );  ?>" />
    <meta property="og:title" content="<?php echo wp_title( "|", true, "right" );  ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo get_site_url(); ?>" />
    <?php
        $og_image_url = get_the_post_thumbnail_url();
        if(empty($og_image_url)) {
            $og_image_url = 'https://www.feuerwehr-aurachhöhe.de/wp-content/uploads/2016/08/apple-touch-icon-180x180.png';
        }
    ?>
    <meta property="og:image" content="<?php echo $og_image_url ?>" />
    <?php    
        $og_excerpt = get_the_excerpt();
        if(!empty($og_excerpt) && (strpos($og_excerpt, "<") === false)) { ?>
    <meta property="og:description" content="<?php echo $og_excerpt ?>" />
    <?php } ?>
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
	<header>
		<div class="header-inner">
			<img class="logo" alt="Retten, Löschen, Schützen, Bergen" src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" />
			<img class="wappen" alt="Wappen" src="<?php echo get_template_directory_uri(); ?>/img/wappen-monochrom.png" />
			<h1><?php bloginfo( "name" ); ?></h1>
			<h2><?php bloginfo( "description" ); ?></h2>
			<form role="search" method="get" id="searchform" class="searchform" action="/">
				<fieldset>
					<input id="s" name="s" type="search" placeholder="Suchbegriff eingeben..." autocomplete="off">
					<button type="submit">Suche</button>
				</fieldset>
			</form>
		</div>
	</header>
	<nav id="site-navigation">
		<?php wp_nav_menu( array( "theme_location" => "header-menu" ) ); ?>
<!--
		<?php
			/*$locations = get_nav_menu_locations();
			$menu = wp_get_nav_menu_object( $locations[ "header-menu" ] );
			$menu_items = wp_get_nav_menu_items( $menu->term_id );
			$this_item = current( wp_filter_object_list( $menu_items, array( 'object_id' => get_queried_object_id() ) ) );
			$submenu = wp_nav_menu( array("menu" => $menu->slug, "submenu" => $this_item->title) );*/
		?>
-->
	</nav>
