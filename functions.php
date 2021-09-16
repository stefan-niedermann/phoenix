<?php
/**
 * Template Name: Theme-Funktionen
 */

	// Remove Generator-Tag in HTML Markup
	remove_action("wp_head", "wp_generator");

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
			'before_widget' => '<li>',
			'after_widget' => '</div></li>',
			'before_title' => '<div class="collapsible-header">',
			'after_title' => '</div><div class="collapsible-body white">'
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

	function phoenix_ffw_remove_hentry( $classes ) {
		$classes = array_diff( $classes, array( 'hentry' ) );
		return $classes;
	}
	add_filter( 'post_class','phoenix_ffw_remove_hentry' );

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

	function phoenix_filter_the_tags() {
		$the_tags = get_the_tags();

		if ($the_tags && count($the_tags) > 0) {
			echo '<ul class="tags">';
			foreach ($the_tags as $tag) {
				echo '<li><a href="' . esc_attr(get_tag_link($tag->term_id)) . '">' . $tag->name . '</a></li>';
			}
			echo '</ul>';
		}
	}
	add_filter( 'the_tags', 'phoenix_filter_the_tags' );

	// Prints a complete teaser
	function the_teaser($classes) {
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(array_merge(array('card'), $classes)); ?>>
			<header class="card-content">
				<h1>
					<a href="<?php the_permalink(); ?>" rel="bookmark" class="waves-effect"><?php the_title(); ?></a>
				</h1>
			</header>
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail("medium_large", ['class' => 'card-image']); ?></a>
			<div class="card-content">
				<?php
					the_excerpt();
					the_tags();
				?>
				<footer>
					<?php
					// Translators: used between list items, there is a space after the comma.
					$categories_list = get_the_category_list(__(', ', 'twentytwelve'));

					$date = sprintf(
						'<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
						esc_url(get_permalink()),
						esc_attr(get_the_time()),
						esc_attr(get_the_date('c')),
						esc_html(get_the_date())
					);

					$author = sprintf(
						'<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
						esc_url(get_author_posts_url(get_the_author_meta('ID'))),
						esc_attr(sprintf(__('View all posts by %s', 'twentytwelve'), get_the_author())),
						get_the_author()
					);

					?>
					<span><i class="material-icons">person</i><?php echo $author; ?></span>
					<span><i class="material-icons">folder</i><?php echo $categories_list; ?></span>
					<span><i class="material-icons">event</i><?php echo $date; ?></span>
				</footer>
			</div>
		</article>
		<?php
	}
?>
