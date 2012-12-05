"use strict";

/*globals $, jQuery, window, document */

(function ($) {
	var i = 0, title, total, go, letters = ['G','o','o','d','b','y','e',' ','P','i','c','a','s','s','o','.'];

	function typing() {
		if (i === total) {
			window.clearInterval(go);
		} else {
			title.append(letters[i]);
			i += 1;
		}
	}
	
	$(document).ready(function () {
		title = $('h1.bandname a');
		total = letters.length;
		go = window.setInterval(typing, 150);
	});

}(jQuery));