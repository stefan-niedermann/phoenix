document.addEventListener("DOMContentLoaded", function() {
	if(null !== document.querySelector("body.single")) {
		// Add Print-Button to News-Articles
		var printButton = document.createElement("a");
		printButton.href = "javascript:window.print();";
		printButton.title = "Diesen Artikel ausdrucken";
		printButton.innerHTML = "Drucken";

		// Add Bookmark-Button to News-Articles
		var bookmarkButton = document.createElement("a");
		bookmarkButton.href = "javascript:bookmark();";
		bookmarkButton.title = "Diesen Artikel als Lesezeichen speichern";
		bookmarkButton.innerHTML = "Lesezeichen";
		bookmarkButton.rel = "sidebar";

		var listItem = document.querySelector(".newsmeta li.actions");
		listItem.appendChild(printButton);
		listItem.appendChild(bookmarkButton);

		/**
		 * Helper Function for displaying Bookmark-Dialoge
		 */
		function bookmark() {
			var title = document.title, url = document.location.href, errorMsg = "Ihr Browser unterstützt leider das automatische Hinzufügen von Lesezeichen / Favoriten nicht.";
			if( window.external ) {
				try {
					window.external.AddFavorite( url, title);
				} catch (e) {
					if(window.chrome) {
						alert("Bitte Strg + D drücken, um diese Seite als Lesezeichen abzuspeichern!");	
					} else {
						alert(errorMsg);
					}
				}
			} else {
				alert(errorMsg);
			}
		}
	}
}, false);