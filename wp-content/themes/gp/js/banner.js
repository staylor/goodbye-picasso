"use strict";

/*globals $, jQuery, window, document */

(function ($) {
	var banner,
		IMAGE_DIR = '/wp-content/uploads/2010/08/',
		IMAGES_SIZE = 20;

	function getIndex() {
		return Math.floor(Math.random() * IMAGES_SIZE) + 1;
	}

	function addImage() {
		banner.find('img').attr({
			src: [IMAGE_DIR, 'header-', getIndex(), '.jpg'].join('')
		});
	}

	$(document).ready(function () {
		banner = $('.banner');

		addImage();
	});

}(jQuery));