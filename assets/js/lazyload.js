(function () {
	'use strict';

	var lazyItems = [].slice.call(document.querySelectorAll('.lazyload'));

	function loadItem(item) {
		if (item.dataset.srcset) {
			item.setAttribute('srcset', item.dataset.srcset);
		}

		if (item.dataset.src) {
			item.setAttribute('src', item.dataset.src);
		}

		if (item.dataset.sizes) {
			item.setAttribute('sizes', item.dataset.sizes);
		}

		item.classList.remove('lazyload');
		item.classList.add('lazyloaded');
	}

	function initLazyLoad() {
		if (!('IntersectionObserver' in window)) {
			lazyItems.forEach(loadItem);
			return;
		}

		var observer = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (!entry.isIntersecting) {
					return;
				}

				loadItem(entry.target);
				observer.unobserve(entry.target);
			});
		}, {
			rootMargin: '200px 0px'
		});

		lazyItems.forEach(function (item) {
			observer.observe(item);
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initLazyLoad);
	} else {
		initLazyLoad();
	}
})();
