try {
	document.addEventListener('DOMContentLoaded', () => {
		// Prevent Context Menu Click
		Array.from(document.querySelectorAll('main img'))
			.forEach(img => img.addEventListener('contextmenu', (e) => e.preventDefault(), false));
	}, false);
} catch (e) {
	console.error(e);
}

if (window.speechSynthesis) {
	try {
		const voice = window.speechSynthesis
			.getVoices()
			.filter(voice => voice.lang.toLowerCase().startsWith('de'))
			.find(() => true);
		if (voice) {
			document.addEventListener('DOMContentLoaded', () => {
				const btn = document.createElement('button');
				const icon = document.createElement('i');
				icon.classList.add('material-icons');
				icon.innerText = 'play_arrow';
				const label = document.createTextNode('Artikel vorlesen');
				btn.appendChild(icon);
				btn.appendChild(label);
				btn.classList.add('speech-synthesis-control');
				btn.classList.add('browser-default');
				btn.addEventListener('click', () => {
					if (btn.classList.contains('speaking')) {
						btn.classList.remove('speaking');
						icon.innerText = 'play_arrow';
						label.textContent = 'Artikel vorlesen';
						window.speechSynthesis.cancel();
						if (window._paq) {
							_paq.push(['trackEvent', 'Speech Synthesis', 'Cancel']);
						}
					} else {
						btn.classList.add('speaking');
						icon.innerText = 'stop';
						label.textContent = 'Vorlesen beenden';
						const utterance = new SpeechSynthesisUtterance(`
							${document.querySelector('main>article h1').innerText}.
							${document.querySelector('main>article>div').innerText}
						`);
						utterance.voice = voice;
						utterance.addEventListener('end', () => btn.click());
						window.speechSynthesis.speak(utterance);
						if (window._paq) {
							_paq.push(['trackEvent', 'Speech Synthesis', 'Play']);
						}
					}
				});
				document.querySelector('main>article>header').appendChild(btn);
			});
		}
	} catch (e) {
		console.error(e);
	}
}