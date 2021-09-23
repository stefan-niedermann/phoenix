try {
	document.addEventListener('DOMContentLoaded', () => {
		// Prevent Context Menu Click
		Array.from(document.querySelectorAll('main img'))
			.forEach(img => img.addEventListener('contextmenu', (e) => e.preventDefault(), false));
	}, false);
} catch(e) {
	console.error(e);
}