<?php
/**
 * Template Name: 404
 * Handelt einen 404-Fehler
 */
wp_enqueue_style( 'sidebar', get_template_directory_uri() . '/style/sidebar.css' );
get_header(); ?>
<main>
	<h1>Die gesuchte Seite wurde nicht gefunden</h1>
	<p>Hoppla, die gesuchte Seite konnten wir leider nicht finden. Entweder ist sie unter einer neuen Adresse verfügbar oder sie hat nie existiert.</p>
	<p>Möchten Sie stattdessen auf unsere <a href="/" title="Startseite">Startseite</a> gehen?</p>
	<p>Wenn Sie der Meinung sind, dass dies ein Fehler von uns ist, können Sie uns gerne kontaktieren. Möglichkeiten zur Kontaktaufnahmen finden Sie im <a href="/impressum/#verantwortlich">Impressum</a>.</p>
</main>
<style type="text/css">
/**
 * Template Name: Startseite
 */
.post-teaser-container article:first-child {
	margin-bottom: 1rem;
}

.post-teaser-container article h1 {
	margin-top: 0;
	margin-bottom: 1rem;
	font-size: medium;
}

@supports(object-fit: cover) {
	.post-teaser-container article img {
		max-height: 200px;
		object-fit: cover;
	}
}

.post-teaser-container article footer {
	color: #666;
	font-size: x-small;
	border-top: 1px solid #aaa;
	text-align: right;
	padding-top: 5px;
}

@media (min-width: 640px) {
	.post-teaser-container article {
		width: 45%;
		width: calc(50% - .5rem);
		float: left;
		box-sizing: border-box;
	}
	.post-teaser-container article:first-child {
		margin-right: 1rem;
	}
}

@media (min-width: 1280px) {
	.post-teaser-container {
		width: 1024px;
		margin: auto;
		margin-top: 1rem;
	}
	.post-teaser-container article {
		padding: 1rem;
		border-radius: 2px;
		box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.25);
		background: #fff;
	}
	.post-teaser-container article:first-child {
		margin-bottom: 0;
	}

	@supports(display: flex) {
		.post-teaser-container {
			display: flex;
		}
		
		.post-teaser-container article {
			display: flex;
			flex-direction: column;
		}
		
		.post-teaser-container article > div {
			flex-grow: 1;
		}
	}
}
</style>
<div class="post-teaser-container">
<?php
	$teaserquery = new WP_Query(array(
		'posts_per_page' => 2,
		'post_type' => 'post',
		'post_status' => 'publish'
	));
    while ( $teaserquery->have_posts() ) {
        $teaserquery->the_post();
        // do stuff
		?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header>
					<h1>
						<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h1>
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail("medium_large"); ?></a>
				</header>
				<div>
					<?php the_excerpt(); ?>
				</div>
				<footer>
					<?php
						// Translators: used between list items, there is a space after the comma.
						$categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );

						// Translators: used between list items, there is a space after the comma.
						$tag_list = get_the_tag_list( '', __( ', ', 'twentytwelve' ) );

						$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
							esc_url( get_permalink() ),
							esc_attr( get_the_time() ),
							esc_attr( get_the_date( 'c' ) ),
							esc_html( get_the_date() )
						);

						$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
							esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
							esc_attr( sprintf( __( 'View all posts by %s', 'twentytwelve' ), get_the_author() ) ),
							get_the_author()
						);

						// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
						if ( $tag_list ) {
							$utility_text = __( 'Dieser Beitrag wurde in %1$s am %3$s<span class="by-author"> von %4$s</span> veröffentlicht. Schlagworte: %2$s', 'twentytwelve' );
						} elseif ( $categories_list ) {
							$utility_text = __( 'Dieser Beitrag wurde in %1$s am %3$s<span class="by-author"> von %4$s</span> veröffentlicht.', 'twentytwelve' );
						} else {
							$utility_text = __( 'Dieser Beitrag wurde in %3$s<span class="by-author"> von %4$s</span> veröffentlicht.', 'twentytwelve' );
						}

						printf(
							$utility_text,
							$categories_list,
							$tag_list,
							$date,
							$author
						);
					?>
				</footer>
			</article>
		<?php
    }
    wp_reset_postdata();
?>
</div>
<?php get_footer(); ?>