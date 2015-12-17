<?php
	// Remove Generator-Tag in HTML Markup
	remove_action("wp_head", "wp_generator");

	// Hide Admin Menu on User Pages
	show_admin_bar( false );

	// Register Navigation Menus
	function phoenix_register_nav_menus() {
		register_nav_menu("header-menu",__( "Header Menu" ));
	}
	add_action( "init", "phoenix_register_nav_menus" );

	// Register Sidebars
	function phoenix_register_sidebars() {
		register_sidebar(array(
			"id" => "main-sidebar",
			"name" => __( "Main Sidebar" )
		));
		register_sidebar(array(
			"id" => "post-sidebar",
			"name" => __( "Post Sidebar" )
		));
	}
	add_action( "init", "phoenix_register_sidebars" );

	// Generate HTML5 Tags
	add_theme_support( "html5", array( "comment-list", "comment-form", "search-form" ) );

	// enables post and comment RSS feed links to head
	add_theme_support( "automatic-feed-links" );
?>
