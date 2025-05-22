<?php
/**
 * Template Name: 150 Jahre Jubiläum
 * Spezialisiertes Template für 150 Jahre Jubiläum
 */
wp_enqueue_style('index', get_template_directory_uri() . '/index.css');

$currentPost = get_post();
$customValues = get_post_custom_values("Post Teaser Kategorie", $currentPost->ID);

if(!empty($customValues) && count($customValues) > 0) {
	wp_enqueue_style('cards', get_template_directory_uri() . '/css/cards.css');
	wp_enqueue_style('tags', get_template_directory_uri() . '/css/tags.css');
}

wp_enqueue_style('150', get_template_directory_uri() . '/css/150.css');
wp_enqueue_style('150-nav', get_template_directory_uri() . '/css/150-nav.css');

get_header(); ?>
<main>
    <style>
        @font-face {
            font-family: RubikDirt;
            src: url(<?php echo get_template_directory_uri() ?>/fonts/RubikDirt-Regular.ttf);
        }

        @font-face {
            font-family: Katibeh;
            src: url(<?php echo get_template_directory_uri() ?>/fonts/Katibeh-Regular.ttf);
        }
    </style>
    <h1><span style="hyphens: none;">150 Jahre</span> Feuerwehr<br class="optional"><span class="optional">Barthel&shy;mes&shy;aurach</span></h1>
    <hr>
    <section>
        <strong id="datum">8. - 10. Mai 2026</strong>
    </section>
    <section>
        <h2>Programm</h2>
        <div class="flex-container">
            <article class="teaser-150">
                <h3>Freitag, 8. Mai</h3>
                <em>Eintritt frei!</em>
                <img src="<?php echo get_template_directory_uri() ?>/img/150/members.png" alt="Logo der Band Members">
                <dl>
                    <dt>19:30 Uhr</dt>
                    <dd><strong>Bieranstich</strong> durch Bürgermeister</dd>
                    <dt>20:00 Uhr</dt>
                    <dd>Eröffnungsparty mit den <strong><a href="https://members-live.de/">Members</a></strong></dd>
                </dl>
            </article>
            <article class="teaser-150">
                <h3>Samstag, 9. Mai</h3>
                <em>Eintritt frei!</em>
                <img src="<?php echo get_template_directory_uri() ?>/img/150/klostergold.png" alt="Logo der Band Klostergold">
                <dl>
                    <dt>17:00 Uhr</dt><dd><strong>Festumzug</strong></dd>
                    <dt>18:00 Uhr</dt><dd>Fahneneinmarsch</dd>
                    <dt>im Anschluss</dt><dd>Party mit <strong><a href="https://klostergold.de/">Klostergold</a></strong></dd>
                </dl>
            </article>
            <article class="teaser-150">
                <h3>Sonntag, 10. Mai</h3>
                <em>Eintritt frei!</em>
                <img src="<?php echo get_template_directory_uri() ?>/img/150/blechglanz.png" alt="Logo der Band Blechglanz">
                <dl>
                    <dt>9:30 Uhr</dt>
                    <dd><strong>Festgottesdienst</strong> mit <strong>Fahnenweihe</strong></dd>
                    <dt>11:30 Uhr</dt>
                    <dd>Stimmungsmusik mit <strong><a href="https://www.blechglanz.net/">Blechglanz</a></strong></dd>
                    <dt>ab 15:00 Uhr</dt>
                    <dd>Kaffee & Kuchen</dd>
                </dl>
            </article>
        </div>
    </section>
    <section class="narrow">
        <h2>Anfahrt</h2>
        <p>Direkt neben dem Festzelt befindet sich eine ausgewiesene Parkfläche.</p>
        <h3>Von der B 466 kommend</h3>
        <p>Fahren Sie an der Abfahrt Barthelmesaurach ab und biegen Sie direkt im Anschluss rechts ab. Fahren Sie am Feuerwehrhaus vorbei, das Festzelt steht an der rechten Seite.</p>
        <h3>Von Mildach / Abenberg kommend</h3>
        <p>Da einige Straßen für den Festumzug gesperrt werden, fahren Sie am Besten über Kammerstein auf die B 466 auf</p>
        <iframe src="https://www.openstreetmap.org/export/embed.html?bbox=10.929526984691622%2C49.27688903652725%2C10.93400627374649%2C49.2784394096516&amp;layer=mapnik"></iframe>
    </section>
	<section>
<?php if ( have_posts() ) { ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(array('flow-text', 'white-text')); ?>>
			<h1 class="section center"><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</article>

		<?php if (comments_open()) {
			comment_form();  ?>
			<ol class="commentlist">
				<?php comments_template(); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below" class="navigation" role="navigation">
				<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'twentytwelve' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentytwelve' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentytwelve' ) ); ?></div>
			</nav>
			<?php endif;
		}
	endwhile;
}
?>
	</section>
</main>
<?php
	get_footer();
?>
