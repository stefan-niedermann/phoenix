"use strict";

document.addEventListener("DOMContentLoaded", function() {
	var ID_SEARCHFORM = "searchform";
	var ID_SITE_NAVIGATION = "site-navigation";
	var CLASS_MENU_HAUPTMENUE_CONTAINER = "menu-hauptmenue-container";
	var CLASS_COLLAPSED = "collapsed";
	var CLASS_CLICKABLE = "clickable";
	var CLASS_EXTERN = "extern";
	var CLASS_HIDDEN = "hidden";
	var STR_SEARCH = "Suchen";
	var STR_MENU = "Menü";
	var EVT_CLICK = "click";

	// Create Menu-Button
	var menuButton = document.createElement("button"),
	menuButtonText = document.createElement("span"),
	siteNavigation = document.getElementById(ID_SITE_NAVIGATION);
	menuButtonText.innerHTML = STR_MENU;
	menuButtonText.classList.add(CLASS_HIDDEN);
	menuButton.appendChild(menuButtonText);
	siteNavigation.appendChild(menuButton);

	// Toggle Menu
	menuButton.addEventListener(EVT_CLICK, function() {
		siteNavigation.classList.toggle(CLASS_COLLAPSED);
		if(siteNavigation.classList.contains(CLASS_COLLAPSED)) {
			document.body.removeEventListener(EVT_CLICK, closeNavigationOnOutsideClick);
		} else {
			searchForm.classList.add(CLASS_COLLAPSED);
			document.body.addEventListener(EVT_CLICK, closeNavigationOnOutsideClick);
		}
	}, true);
	siteNavigation.classList.add(CLASS_COLLAPSED);

	function closeNavigationOnOutsideClick(event) {
		var el = event.target,
		menuHauptmenueContainer = siteNavigation.getElementsByClassName(CLASS_MENU_HAUPTMENUE_CONTAINER)[0],
		outside = true;
		if(el.parentElement !== menuHauptmenueContainer.parentElement) {
			while(el !== document.body) {
				if(el == menuHauptmenueContainer) {
					outside = false;
					break;
				}
				el = el.parentElement;
			}
			if(outside) {
				siteNavigation.classList.add(CLASS_COLLAPSED);
			}
		}
	}

	// Create Search-Button
	var searchButton = document.createElement("button"),
	searchButtonImg = document.createElement("img"),
	searchForm = document.getElementById(ID_SEARCHFORM);
	searchButtonImg.setAttribute("alt", STR_SEARCH);
	searchButtonImg.setAttribute("type", "button");
	searchButtonImg.setAttribute("src", "/wp-content/themes/phoenix/img/search.svg");
	searchButton.appendChild(searchButtonImg);
	searchForm.appendChild(searchButton);

	// Toogle Search
	searchButton.addEventListener(EVT_CLICK, function(e) {
		e.preventDefault();
		searchForm.classList.toggle(CLASS_COLLAPSED);
		if(!searchForm.classList.contains(CLASS_COLLAPSED)) {
			siteNavigation.classList.add(CLASS_COLLAPSED);
			searchForm.querySelector("input").focus();
		}
	}, false);
	searchForm.classList.toggle(CLASS_COLLAPSED);

	// Open external Anchors in new Tab
	var externalAnchors = document.querySelectorAll("a[href^=\"http://\"], a[href^=\"https://\"], a.extern");
	for(var i = 0; i < externalAnchors.length; i++) {
		var externalAnchor = externalAnchors[i];
		if(externalAnchor.host !== location.host) {
			externalAnchor.setAttribute("target", "_blank");
			externalAnchor.classList.add(CLASS_EXTERN);
		}
	}

	// Open anchors in list elements on list element click
	var listElements = document.querySelectorAll("ul.colored > li, ol.colored > li, ul.lv-link-list > li");
		for(var i = 0; i < listElements.length; i++) {
			if(listElements[i].getElementsByTagName("a").length > 0) {
				listElements[i].classList.add(CLASS_CLICKABLE);
				listElements[i].addEventListener(EVT_CLICK, function(e){
					e.target.getElementsByTagName("a")[0].click();
				});
			}
		}
}, false);


