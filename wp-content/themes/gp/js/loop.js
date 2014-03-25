"use strict";

/*globals window, document, $, jQuery, XHR */

(function ($) {
	var wrapper;

	function goToGallery() {
		window.location.href = $(this).closest('.entry-content').prev('h2').find('a').attr('href');
		return false;
	}

	$(document).ready(function () {
		wrapper = $('#loop-content');

		$('body')
			.on('click', '.band_gallery_strip_wrapper', goToGallery)
			.on('click', '#nav-above a, #nav-below a', function () {
				var href = elem.attr('href') + (elem.attr('href').indexOf('?') > -1 ? '&ajax=1' : '?ajax=1');
				XHR.doRequest(href, wrapper);
				return false;
			} );
	});
}(jQuery));
