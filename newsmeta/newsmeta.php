<?php
/*
 * Plugin Name: News Meta
 * Description: Displays the post image and other meta-information like category, author, ... to the current post on your sidebar. Benefits if WP-Piwik is installed
 * Author: Niedermann IT-Dienstleistungen
 * Version: 0.5.0
 */

class NewsMetaWidget extends WP_Widget {
    
	function NewsMetaWidget() {
		$widget_ops = array('classname' => 'NewsMetaWidget', 'description' => 'Displays Category and other meta-information to the current post on your sidebar.' );
		$this->WP_Widget('NewsMetaWidget', 'News Meta', $widget_ops);
	}
 
 	/**
 	 * The form displayed on the Widgets Page in the Admin Area
 	 */
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
?>
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>">Title:
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
		</label>
	</p>
<?php
	}
 
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		return $instance;
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		
		echo "<aside class=\"newsmeta\">";
 
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
		if (!empty($title))
			echo $before_title . $title . $after_title;
 
		$currentPost = get_post();
	
		$categories_list = get_the_category_list( __( ' ' ) );
		$tags_list = get_the_tag_list( __( ' ' ) );
		$authorObject = get_userdata($currentPost->post_author);
		$authorName = $authorObject->first_name.' '.$authorObject->last_name;
		$creationDateObject = new DateTime($currentPost->post_date);
		$creationDate = $creationDateObject->format('d.m.Y H:m');
		$modifiedDateObject = new DateTime($currentPost->post_modified);
		$modifiedDate = $modifiedDateObject->format('d.m.Y H:m');
		
		echo get_the_post_thumbnail( $currentPost->ID, 'medium', array('class' => 'newsmeta-image') );
		echo "
			<ul>
				<li>
					<strong>Autor</strong>
					<span class=\"author\"><a href=\"" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "\">" . get_the_author_meta('display_name') . "</a></span>
				</li>
				<li>
					<strong>Erstellt</strong>
					<span class=\"published\">" . sprintf( '<time class="entry-date" datetime="%1$s">%2$s</time>',
							esc_attr( get_the_date( 'c' ) ),
							esc_html( get_the_date("j. M. Y H:i") )
					) . " Uhr</span>
				</li>";
		if($modifiedDate > $creationDate) {
			echo "
				<li>
					<strong>Bearbeitet</strong>
					<span class=\"modified\">"  . sprintf( '<time class="entry-date" datetime="%1$s">%2$s</time>',
							esc_attr( get_the_modified_date( 'c' ) ),
							esc_html( get_the_modified_date("j. M. Y H:i") )
					) . " Uhr</span>
				</li>";
		}
		if(shortcode_exists('wp-piwik')) {
			$hits = 0;
			ob_start();
			do_shortcode('[wp-piwik module="post" range="2012-09-05,' . date('Y-m-d') . '" key="nb_hits"]');
			$hits = ob_get_contents();
			ob_end_clean();
			if(intval($hits) > 1) {
				echo "<li><strong>Aufrufe</strong>" . $hits . "</li>";
			}
		}
		$customValues = get_post_custom_values("Quelle", $currentPost->ID);
		if(!empty($customValues)) {
			echo "
				<li>";
			if(count($customValues) > 1) {
				echo "
					<strong>Quellen</strong>
					<ul>";
				foreach($customValues as $customValue) {
					echo "
						<li>
							$customValue
						</li>";
				}
				echo "
					</ul>";
			} else {
				$customValue = $customValues[0];
				echo "
					<strong>Quelle</strong>
					$customValue";
			}
			echo "
				</li>";
		}
		echo "
				<li>
					<strong>Kategorien</strong>
					$categories_list
				</li>";
		if(!empty($tags_list)) {
		echo "
				<li>
					<strong>Tags</strong>
					$tags_list
				</li>";
		}
		echo "
				<li class=\"actions\">
					<strong>Aktionen</strong>
				</li>
			</ul>
		";
		echo "</aside>";
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("NewsMetaWidget");') );

// Enqueue CSS and JS
function it_niedermann_add_style_and_script() {
		wp_enqueue_script( 'newsmeta', plugins_url( '/newsmeta.js', __FILE__ ) );
		wp_enqueue_style( 'newsmeta', plugins_url( '/newsmeta.css', __FILE__ ) );
}
add_action('wp_enqueue_scripts', 'it_niedermann_add_style_and_script');
?>