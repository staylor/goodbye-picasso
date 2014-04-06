/*globals window, document, $, jQuery*/

(function ($) {
	"use strict";
	var wrapper;

	function getBigSrc() {
		var link = $(this), src;
		src = link.find('img').attr('src');
		link.attr('href', src.replace(/-150x150/g, '').replace(/jpg/g, 'jpeg'));
	}

	function check_title(title) {
		return title !== 'photo' && (title.indexOf('photo-') === -1) ? title : '';
	}

	$(document).ready(function () {
		wrapper = $('#loop-content');

	});
}(jQuery));
