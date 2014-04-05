/*globals $, jQuery, document */

(function ($) {
	"use strict";

	var items = [2, 4, 6, 7, 9, 10];

	function getIndex() {
		return items[Math.floor(Math.random() * items.length) + 1];
	}

	$(document).ready(function () {
		$('.banner').find('img').attr({
			src: ['/wp-content/uploads/2010/08/header-', getIndex(), '.jpg'].join('')
		});
	});

}(jQuery));