window.addEventListener("load", function() {
	/**
	 * Helper Function for sorting News-Articles
	 * @param String side - left, right
	 * @returns int complete height of the specified side
	 */
	function get_height(side) {
		sortednews = document.querySelectorAll(".archive article.sorted-" + side);
		height = 0;
		for(var i = 0; i < sortednews.length; i++) {
		  var temp = sortednews[i];
		  height += temp.offsetHeight;
		  /*
		   * Returns Margin with unit e.g. px, em, ...
		   * var style = temp.currentStyle || window.getComputedStyle(temp);
		   * height += style.marginTop;
		   * height += style.marginBottom;
		   */
		   height += 20;
		}
		return height;
	}
	
	(function order_articles() {
		// Artikel anordnen
		var news = document.querySelectorAll(".archive article");
		for(var i = 0; i < news.length; i++) {
			var temp = news[i];
			height_left = get_height("left");
			height_right = get_height("right");
			if(height_left <= height_right) {
				temp.classList.add("sorted-left");
			} else {
				temp.classList.add("sorted-right");
			}
		}
	})();
}, false);
