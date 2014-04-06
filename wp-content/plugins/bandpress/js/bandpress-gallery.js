"use strict";

/*globals window, document, $, jQuery*/

(function ($) {
	var wrapper, galleries;

	function getBigSrc() {
		var link = $(this), src;
		src = link.find('img').attr('src');
		link.attr('href', src.replace(/-150x150/g, '').replace(/jpg/g, 'jpeg'));
	}

	function check_title(title) {
		return title !== 'photo' && (title.indexOf('photo-') === -1) ? title : '';
	}

	function doGalleries() {
		var elem = $(this), nav = $('#nav-above a');

		nav.each(function () {
			var elem = $(this);

			XHR.ajaxify(elem, function () {
				XHR.doRequest(elem.attr('href'), wrapper, function () {
					galleries = $('.band_gallery');
					galleries.each(doGalleries);
				});

				return false;
			});
		});

		elem.find('a').each(getBigSrc).fancybox({
			'cyclic'		: true,
			'centerOnScroll': true,
			'overlayColor'  : '#000',
			'overlayOpacity': '0.6',
			'changeFade'    : 100,
			'enableEscapeButton': true,
			'transitionIn'	: 'elastic',
			'transitionOut'	: 'elastic',
			'easingIn'      : 'easeOutBack',
			'easingOut'     : 'easeInBack',
			'titlePosition' : 'over',
			'titleFormat'   : function (title, currentArray, currentIndex, currentOpts) {
		    	return '<span id="fancybox-title-over">Image ' +
		    		(currentIndex + 1) + ' of ' + currentArray.length + ' <p class="band_gallery_p"> ' +
		    			check_title(title) + '</p>' +
		    	'</span>';
			}
		});
	}

	$(document).ready(function () {
		wrapper = $('#band-gallery-content');
		if ( wrapper.length ) {
			galleries = $('.band_gallery');
			galleries.each(doGalleries);
		}
	});
}(jQuery));
