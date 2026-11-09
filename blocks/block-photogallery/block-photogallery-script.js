import { init } from './lite-light.min.js';

init({
	imageSelector: '.ps-gallery .lightbox',
	imageUrlAttribute: 'data-gallery',
	swipeThreshold: 75,
	fadeAnimationDuration: 200,
});
