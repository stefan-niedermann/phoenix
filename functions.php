<?php
/**
 * Template Name: Theme-Funktionen
 */
	// Remove Generator-Tag in HTML Markup
	remove_action("wp_head", "wp_generator");

	// Hide Admin Menu on User Pages
	show_admin_bar( false );

	// Generate HTML5 Tags
	add_theme_support( "html5", array( "comment-list", "comment-form", "search-form" ) );

	// enables post and comment RSS feed links to head
	add_theme_support( "automatic-feed-links" );

	// Featured Images
	add_theme_support( 'post-thumbnails' );

	// Register Navigation Menus
	function phoenix_register_nav_menus() {
		register_nav_menu("header-menu",__( "Header Menu" ));
		register_nav_menu("footer-menu",__( "Footer Menu" ));
	}
	add_action( "init", "phoenix_register_nav_menus" );

	// Register Sidebars
	function phoenix_register_sidebars() {
		register_sidebar(array(
			"id" => "main-sidebar",
			"name" => __( "Main Sidebar" ),
			'before_widget' => '<aside>',
			'after_widget' => '</aside>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
		));
		register_sidebar(array(
			"id" => "post-sidebar",
			"name" => __( "Post Sidebar" ),
			'before_widget' => '<aside>',
			'after_widget' => '</aside>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
		));
	}
	add_action( "init", "phoenix_register_sidebars" );

	// Set Menu Point to active on News
	function get_news_nav_class( $classes, $item ) {
		if($item->ID == 1820 ) {
			$classes[] = 'current_page_item';
		}
		return $classes;
	}

	function it_niedermann_ffw_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() )
			return $title;

		$title .= get_bloginfo( 'name' );

		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";

		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

		return $title;
	}
	add_filter( 'wp_title', 'it_niedermann_ffw_title', 10, 2 );
?>
