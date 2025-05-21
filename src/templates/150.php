<?php
/**
 * Template Name: 150 Jahre Jubiläum
 * Spezialisiertes Template für 150 Jahre Jubiläum
 */
wp_enqueue_style('150', get_template_directory_uri() . '/css/150.css');
wp_enqueue_style('150-nav', get_template_directory_uri() . '/css/150-nav.css');

get_header();
?>
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
            <article>
                <h3>Freitag, 8. Mai</h3>
                <em>Eintritt frei!</em>
                <img src="<?php echo get_template_directory_uri() ?>/img/150/members.png" alt="Logo der Band Members">
                <ul>
                    <li>19:30 Uhr: Bieranstich durch Bürgermeister</li>
                    <li>20:00 Uhr: Eröffnungsparty mit den Members</li>
                </ul>
            </article>
            <article>
                <h3>Samstag, 9. Mai</h3>
                <em>Eintritt frei!</em>
                <img src="<?php echo get_template_directory_uri() ?>/img/150/klostergold.png" alt="Logo der Band Klostergold">
                <ul>
                    <li>17:00 Uhr: Festumzug</li>
                    <li>18:00 Uhr: Fahneneinmarsch</li>
                    <li>im Anschluss: Party mit Klostergold</li>
                </ul>
            </article>
            <article>
                <h3>Sonntag, 10. Mai</h3>
                <em>Eintritt frei!</em>
                <img src="<?php echo get_template_directory_uri() ?>/img/150/blechglanz.avif" alt="Logo der Band Blechglanz">
                <ul>
                    <li>9:30 Uhr: Festgottesdienst mit Fahnenweihe</li>
                    <li>11:30 Uhr: Stimmungsmusik mit Blechglanz</li>
                    <li>ab 15:00 Uhr: Kaffee & Kuchen</li>
                </ul>
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
</main>
<?php get_footer(); ?>
