(function () {
	'use strict';

	const debounce = function (func, delay) {
		let timer;
		return function () {
			const context = this;
			const args = arguments;
			clearTimeout(timer);
			timer = setTimeout(function () {
				func.apply(context, args);
			}, delay);
		};
	};

	const throttle = (func, limit) => {
		let lastFunc;
		let lastRan;
		return function () {
			const context = this;
			const args = arguments;
			if (!lastRan) {
				func.apply(context, args);
				lastRan = Date.now();
			} else {
				clearTimeout(lastFunc);
				lastFunc = setTimeout(function () {
					if (Date.now() - lastRan >= limit) {
						func.apply(context, args);
						lastRan = Date.now();
					}
				}, limit - (Date.now() - lastRan));
			}
		};
	};

	const wrapper = document.getElementById('wrapper-id');
	const body = document.body;
	const siteHeader = document.getElementById('headerID');
	const menuBtn = document.getElementById('menuBtnID');
	const btnSOS = document.getElementById('btn-sosID');
	const scrollLink = document.getElementById('scrolllinkID');
	const navSwitches = document.querySelectorAll('.nav-switch');
	const preventDefaultLinks = document.querySelectorAll('.prevent-default');
	const observedItems = document.querySelectorAll('.scroll-trigger');

	if (!wrapper) {
		return;
	}

	let scrollDir = 'down';
	let lastScrollTop = 0;
	let scrollDist = 0;
	let winH = 0;
	const scrollMin = 20;

	function toggleSOS() {
		if (!btnSOS) {
			return;
		}

		const scrollTop = document.scrollingElement.scrollTop;
		scrollDir = scrollTop > lastScrollTop ? 'down' : 'up';
		lastScrollTop = scrollTop;

		if (scrollTop > 120 && scrollDir === 'down') {
			btnSOS.classList.add('scroll-minified');
		}
		if (scrollTop < 100 && scrollDir === 'up') {
			btnSOS.classList.remove('scroll-minified');
		}
	}

	function toggleSiteHeader(hide) {
		if (!siteHeader) {
			return;
		}

		if (hide) {
			siteHeader.classList.add('scrolled-OFF');
		} else {
			siteHeader.classList.remove('scrolled-OFF');
		}

		if (menuBtn) {
			menuBtn.checked = false;
		}
	}

	function setStickyOffsetVariables() {
		const elements = document.querySelectorAll('.faq-item--headline');
		const viewportHeight = window.innerHeight;
		const totalHeight = Array.from(elements).reduce(
			(sum, element) => sum + element.offsetHeight,
			0
		);

		if (totalHeight <= viewportHeight) {
			let previousHeight = 0;
			elements.forEach((element, index) => {
				previousHeight = element.offsetHeight * index;
				element.style.setProperty('--sticky-offset', `${previousHeight}`);
			});
		} else {
			elements.forEach((element) => {
				element.style.setProperty('--sticky-offset', '1');
			});
		}
	}

	function bindPreventDefaults() {
		preventDefaultLinks.forEach((el) => {
			el.addEventListener('click', function (event) {
				event.preventDefault();
			});
		});
	}

	function setupIntersectionObserver() {
		const observer = new IntersectionObserver(
			function (entries) {
				entries.forEach(function (entry) {
					if (entry.intersectionRatio > 0.2) {
						entry.target.classList.add('inView');
					}
				});
			},
			{
				rootMargin: '-50% 0px -15% 0px',
				threshold: [0, 0.25, 0.5, 0.75, 1],
			}
		);

		observedItems.forEach(function (item) {
			observer.observe(item);
		});
	}

	function addMenuBtnListeners() {
		navSwitches.forEach(function (navSwitch) {
			navSwitch.addEventListener('click', menuBtnChange);
		});

		if (scrollLink) {
			scrollLink.addEventListener('click', function (event) {
				event.preventDefault();
				window.scrollTo({ top: 0, behavior: 'smooth' });
			});
		}
	}

	function menuBtnChange(event) {
		navSwitches.forEach(function (navSwitch) {
			if (navSwitch !== event.target) {
				navSwitch.checked = event.target.checked;
			}
		});
	}

	function addWindowListeners() {
		window.addEventListener(
			'scroll',
			throttle(function () {
				body.classList.remove('firsttime-load');

				const scrollTop = document.scrollingElement.scrollTop;
				scrollDir = scrollTop > lastScrollTop ? 'down' : 'up';

				if (scrollDir === 'up') {
					scrollDist = lastScrollTop - scrollTop;
				}
				lastScrollTop = scrollTop;

				if (
					(scrollDir === 'up' && scrollTop < 150) ||
					(scrollDir === 'up' && scrollDist > scrollMin)
				) {
					toggleSiteHeader(false);
					if (btnSOS) {
						btnSOS.classList.add('scroll-minified');
					}
				} else if (scrollDir === 'down' && scrollTop > 150) {
					toggleSiteHeader(true);
				}

				if (scrollTop > winH * 1.15 && scrollDir === 'down') {
					if (siteHeader) {
						siteHeader.classList.add('scrolled');
					}

					if (scrollTop >= wrapper.offsetHeight * 0.8) {
						if (btnSOS) {
							btnSOS.classList.remove('scroll-minified');
						}
					} else if (btnSOS) {
						btnSOS.classList.add('scroll-minified');
					}
				} else if (scrollTop < winH * 1.15 && scrollDir === 'up') {
					if (siteHeader) {
						siteHeader.classList.remove('scrolled');
					}
				}
			}, 500)
		);

		window.addEventListener(
			'resize',
			debounce(function () {
				winH = window.innerHeight;
				setStickyOffsetVariables();
			}, 200)
		);
	}

	const isSafari = !!navigator.userAgent.match(/Version\/[\d.]+.*Safari/);
	const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
	const isAndroid = navigator.userAgent.toLowerCase().indexOf('android') > -1;

	if (!isSafari && !isAndroid) {
		wrapper.classList.add('is-desktop');
	}

	function docLoaded() {
		window.removeEventListener('load', docLoaded);

		if (wrapper.classList.contains('loading')) {
			wrapper.classList.remove('loading');
			wrapper.classList.add('loaded');
		}

		if (window.IntersectionObserver) {
			setupIntersectionObserver();
			document.body.classList.add('io-supported');
		}

		winH = window.innerHeight;
		addMenuBtnListeners();
		bindPreventDefaults();
		addWindowListeners();
		setStickyOffsetVariables();
	}

	window.addEventListener('load', docLoaded);
})();
