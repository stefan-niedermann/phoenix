<?php

/**
 * Template Name: Footer
 * Bindet das Footer-Menü ein
 */
?>
<footer class="section black white-text">
	<?php wp_nav_menu(array(
		"theme_location" => "footer-menu",
		"menu_class" => "container"
	)); ?>
</footer>
</body>

</html>