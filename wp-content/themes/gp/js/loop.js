"use strict";

/*globals window, document, $, jQuery, XHR */

(function ($) {
	var wrapper, strips;

	function goToGallery() {
		window.location.href = $(this).closest('.entry-content').prev('h2').find('a').attr('href');
		return false;
	}

	function doNav() {
		// add click events to page nav, will request loop pieces via AJAX
		var nav = $('#nav-above a, #nav-below a');
	
		// add click to entire photo strip, goes to Gallery page
		strips = $('.band_gallery_strip_wrapper');
		strips.click(goToGallery);
		
		// dynamically render Tweet button
		$.getScript('http://platform.twitter.com/widgets.js');
		
		nav.each(function () {
			var elem = $(this);
		
			XHR.ajaxify(elem, function () {
				XHR.doRequest(elem.attr('href'), wrapper, doNav);
				return false;				
			});
		});
	}	
	
	$(document).ready(function () {
		wrapper = $('#loop-content');
		
		doNav();
	});
}(jQuery));
