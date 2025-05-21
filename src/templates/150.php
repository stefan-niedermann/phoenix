<?php
/**
 * Template Name: 150 Jahre Jubiläum
 * Spezialisiertes Template für 150 Jahre Jubiläum
 */
wp_enqueue_style('150', get_template_directory_uri() . '/css/150.css');

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
    <h1>150 Jah&shy;re Feuer&shy;wehr<br><span>Barthelmesaurach</span></h1>
    <hr>
    <section>
        <strong id="datum">8. - 10. Mai 2026</strong>
    </section>
    <section>
        <h2>Programm</h2>
        <div class="flex-container">
            <article>
                <h3>Freitag, 8. Mai</h3>
                <p>
                    <em>Eintritt frei!</em>
                    <img src="<?php echo get_template_directory_uri() ?>/img/150/members.png" alt="Logo der Band Members">
                </p>
                <ul>
                    <li>19:30 Uhr: Bieranstich durch Bürgermeister</li>
                    <li>20:00 Uhr: Eröffnungsparty mit den Members</li>
                </ul>
            </article>
            <article>
                <h3>Samstag, 9. Mai</h3>
                <p>
                    <em>Eintritt frei!</em>
                    <img src="<?php echo get_template_directory_uri() ?>/img/150/klostergold.png" alt="Logo der Band Klostergold">
                </p>
                <ul>
                    <li>17:00 Uhr: Festumzug</li>
                    <li>18:00 Uhr: Fahneneinmarsch</li>
                    <li>im Anschluss: Party mit Klostergold</li>
                </ul>
            </article>
            <article>
                <h3>Sonntag, 10. Mai</h3>
                <p>
                    <em>Eintritt frei!</em>
                    <img src="<?php echo get_template_directory_uri() ?>/img/150/blechglanz.avif" alt="Logo der Band Blechglanz">
                </p>
                <ul>
                    <li>9:30 Uhr: Festgottesdienst mit Fahnenweihe</li>
                    <li>11:30 Uhr: Stimmungsmusik mit Blechglanz</li>
                    <li>ab 15:00 Uhr: Kaffee & Kuchen</li>
                </ul>
            </article>
        </div>
    </section>
    <section>
        <h2>Anfahrt</h2>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d818.9529535824391!2d10.93142323620655!3d49.277437699719485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sde!2sde!4v1747812934079!5m2!1sde!2sde"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>
</main>
<?php get_footer(); ?>
