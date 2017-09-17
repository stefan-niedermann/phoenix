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

	function it_niedermann_ffw_remove_hentry( $classes ) {
		$classes = array_diff( $classes, array( 'hentry' ) );
		return $classes;
	}
	add_filter( 'post_class','it_niedermann_ffw_remove_hentry' );

	/* http://wordpress.stackexchange.com/questions/2802/display-a-portion-branch-of-the-menu-tree-using-wp-nav-menu/2809#2809 */
	add_filter( 'wp_nav_menu_objects', 'submenu_limit', 10, 2 );

	function submenu_limit( $items, $args ) {
		if ( empty( $args->submenu ) ) {
			return $items;
		}
		$ids = wp_filter_object_list( $items, array( 'title' => $args->submenu ), 'and', 'ID' );
		$parent_id = array_pop( $ids );
		$children = submenu_get_children_ids( $parent_id, $items );
		foreach ( $items as $key => $item ) {
			if ( ! in_array( $item->ID, $children ) ) {
			unset( $items[$key] );
			}
		}
		return $items;
	}

	function submenu_get_children_ids( $id, $items ) {
		$ids = wp_filter_object_list( $items, array( 'menu_item_parent' => $id ), 'and', 'ID' );
		foreach ( $ids as $id ) {
			$ids = array_merge( $ids, submenu_get_children_ids( $id, $items ) );
		}
		return $ids;
	}

	// Tabellenkopf und -fuß um Felder erweitern
	function phoenix_edit_admin_columns($columns) {
		// TODO Vielleicht kann man die neue Spalte auch in $columns pushen?
		return array(
			'cb' => '<input type="checkbox" />',
			'title' => __('Title'),
			'source' => 'Quelle',
			'author' => __('Author'),
			'comments' => '<span class="vers comment-grey-bubble" title="' . __( 'Comments' ) . '"><span class="screen-reader-text">' . __( 'Comments' ) . '</span></span>',
			'date' => __('Date')
		);
	}
	add_filter('manage_edit-post_columns', 'phoenix_edit_admin_columns');

	// Inhalte aus benutzerdefinierten Feldern auslesen und den Spalten hinzufügen
	function phoenix_post_custom_columns($column) {
		global $post;
		switch ($column) {
			case "source":
				echo get_post_meta($post->ID, 'Quelle', true );
			break;
		}
	}
	add_action('manage_post_posts_custom_column', 'phoenix_post_custom_columns');
?>
