"use strict";

document.addEventListener("DOMContentLoaded", function() {
	document.body.classList.add("js");

	// Create Menu-Button
	var menuButton = document.createElement("button"),
	menuButtonImg = document.createElement("img");
	menuButtonImg.setAttribute("alt", "Menü");
	menuButtonImg.setAttribute("src", "/wp-content/themes/phoenix/img/menu.svg");
	menuButton.appendChild(menuButtonImg);
	document.getElementById("site-navigation").appendChild(menuButton);

	// Toggle Menu
	menuButton.addEventListener("click", function () {
	    document.getElementById("site-navigation").classList.toggle("active");
	}, false);

	// Make Link-Boxes clickable
	var links = document.getElementById("links");
	if(links !== null) {
		var linkElems = links.children;
		for(var i = 0; i < linkElems.length; i++) {
			linkElems[i].classList.add("eingeklappt");
			linkElems[i].getElementsByTagName("h2")[0].addEventListener("click", function() {
				this.parentNode.classList.toggle("eingeklappt");
			}, false);
		}
	}

	// Open external Anchors in new Tab
	var externalAnchors = document.querySelectorAll("a[href^=\"http://\"], a[href^=\"https://\"], a.extern");
	for(var i = 0; i < externalAnchors.length; i++) {
		var externalAnchor = externalAnchors[i];
		if(externalAnchor.host !== location.host) {
			externalAnchor.setAttribute("target", "_blank");
			externalAnchor.classList.add("extern");
		}
	}


	// TODO
	/*var urlInputs = document.querySelectorAll("input[type="url"]");
	for(var i = 0; i < urlInputs.length; i++) {
		var urlInput = urlInputs[i];
		urlInput.addEventListener("change", function(elem) {
			if(!val.startsWith("http://") && !val.startsWith("https://") && val != "")
			$(this).val("http://" + val);
		}, false);
	}

	$(".header .global-search form").submit(function() {
		$search = $(this).find("input[type="search"]");
		if($search.val() == "") {
			$search.focus();
			return false;
		}
	});*/
}, false);
