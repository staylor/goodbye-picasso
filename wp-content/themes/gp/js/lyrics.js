"use strict";

/*globals $, jQuery, window, document */

(function ($) {
	var lyrics;

	function doWriting(j) {
		var i = 0, elem = $(this), words, letters, total, go;
		
		if (j === 0) {
			words = elem.text();
			letters = words.split('');
			total = letters.length;		
		
			elem.text('').css('visibility', 'visible');
			
			go = window.setInterval(function () {
				if (i === total) {
					window.clearInterval(go);
				} else {
					elem.append(letters[i]);
					i += 1;
				}		
			}, 25);		
		} else {
			elem.css('visibility', 'visible');
		}	
	}
	
	$(document).ready(function () {
		if (!$('body').hasClass('page-template-media-php')) {
			lyrics = $('span.lyrics');
			lyrics.each(doWriting);			
		}
	});

}(jQuery));