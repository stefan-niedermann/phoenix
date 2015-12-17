<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
		<div class="ad" style="border-top: 1px solid #600;padding: 10px; margin: 10px -10px 0 -10px;text-align: center;">
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- FFW Widget -->
			<ins class="adsbygoogle"
			     style="display:inline-block;width:728px;height:90px"
			     data-ad-client="ca-pub-3162933551127981"
			     data-ad-slot="3963226721"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		</div>
	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
		<?php wp_nav_menu( array( "theme_location" => "footer-menu", "menu_class" => "nav-menu" ) ); ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
