"use strict";

/*globals window, document, $, jQuery*/

(function ($) {
	var wrapper, strips;

	function goToGallery() {
		window.location.href = $(this).closest('.entry-content').prev('h2').find('a').attr('href');
		return false;
	}

	function doNav() {
		var nav = $('#nav-above a, #nav-below a');
		
		strips = $('.band_gallery_strip_wrapper');
		strips.click(goToGallery);
		
		nav.each(function () {
			var elem = $(this);
		
			XHR.ajaxify(elem, function () {
				XHR.doRequest(elem.attr('href'), wrapper, doNav);
				return false;				
			});
		});
	}	
	
	$(document).ready(function () {
		wrapper = $('#band-galleries-content');
		
		doNav();
	});
}(jQuery));
