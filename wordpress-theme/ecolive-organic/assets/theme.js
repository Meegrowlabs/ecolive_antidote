/**
 * Ecolive Organic Precision — minimal client-side behaviour.
 *
 * - mobile menu toggle (with aria-expanded)
 * - reading-progress bar on single posts
 * - copy-link button on single-post share row
 * - elevation cue: drop a stronger shadow on the glass nav once scrolled
 */
(function () {
	'use strict';

	function ready(fn) {
		if (document.readyState !== 'loading') { fn(); return; }
		document.addEventListener('DOMContentLoaded', fn);
	}

	ready(function () {
		// Mobile menu
		var toggle = document.getElementById('eco-mobile-toggle');
		var menu   = document.getElementById('eco-mobile-menu');
		if (toggle && menu) {
			toggle.addEventListener('click', function () {
				var open = menu.classList.toggle('is-open');
				toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
				var icon = toggle.querySelector('.material-symbols-outlined');
				if (icon) { icon.textContent = open ? 'close' : 'menu'; }
			});
			menu.querySelectorAll('a').forEach(function (a) {
				a.addEventListener('click', function () {
					menu.classList.remove('is-open');
					toggle.setAttribute('aria-expanded', 'false');
					var icon = toggle.querySelector('.material-symbols-outlined');
					if (icon) { icon.textContent = 'menu'; }
				});
			});
		}

		// Reading progress (single posts only — bar exists only there)
		var bar = document.getElementById('eco-progress-bar');
		var nav = document.querySelector('.eco-site-header');
		function onScroll() {
			if (bar) {
				var h   = document.documentElement;
				var max = h.scrollHeight - h.clientHeight;
				var pct = max > 0 ? (h.scrollTop / max) * 100 : 0;
				bar.style.width = pct + '%';
			}
			if (nav) {
				if (window.scrollY > 50) { nav.style.boxShadow = '0 20px 40px rgba(24, 28, 27, 0.08)'; }
				else { nav.style.boxShadow = ''; }
			}
		}
		window.addEventListener('scroll', onScroll, { passive: true });
		onScroll();

		// Copy-link buttons in the share row
		document.querySelectorAll('[data-copy]').forEach(function (btn) {
			btn.addEventListener('click', function (e) {
				e.preventDefault();
				var url = btn.getAttribute('data-copy');
				if (!url || !navigator.clipboard) { return; }
				navigator.clipboard.writeText(url).then(function () {
					var icon = btn.querySelector('.material-symbols-outlined');
					if (icon) {
						var prev = icon.textContent;
						icon.textContent = 'check';
						setTimeout(function () { icon.textContent = prev; }, 1400);
					}
				});
			});
		});
	});
})();
