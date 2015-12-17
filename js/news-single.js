document.addEventListener("DOMContentLoaded", function() {
	// Prevent Context Menu Click
	var elements = document.querySelectorAll("#gallery-1 img");
	for(var i = 0; i < elements.length; i++) {
		elements[i].addEventListener("contextmenu", function(e) {
			e.preventDefault();
		}, false);
	};   
}, false);
