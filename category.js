document.addEventListener("DOMContentLoaded", function() {
	var section = document.querySelector("section");
	var form = document.createElement("form");
	form.setAttribute("class", "filter");
	var input = document.createElement("input");
	input.setAttribute("placeholder", "Durchsuchen");
	var listItems = section.getElementsByTagName("li");
	input.addEventListener("keyup", function() {
		var term = input.value.toLowerCase().trim();
		console.log(term);
		for(var i = 0; i < listItems.length; i++) {;
			if(listItems[i].innerText.toLowerCase().indexOf(term) >= 0) {
				listItems[i].style.display = "block";
			} else {
				listItems[i].style.display = "none";
			}
		}
	});

	form.appendChild(input);
	section.parentNode.insertBefore(form, section);
});