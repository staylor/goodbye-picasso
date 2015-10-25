/*globals window, document, $, jQuery */

(function ($) {
	"use strict";

	var wrapper,
		lyrics,
		bannerItems = [2, 4, 6, 7, 9, 10];

	function getBannerIndex() {
		return bannerItems[Math.floor(Math.random() * bannerItems.length)];
	}

	function goToGallery(e) {
		window.location.href = $( e.currentTarget ).closest('.entry-content').prev('h2').find('a').attr('href');
		return false;
	}

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
		$('.banner').find('img').attr({
			src: ['/wp-content/uploads/2010/08/header-', getBannerIndex(), '.jpg'].join('')
		});

		wrapper = $('#loop-content');

		$( document.body ).on( 'click', '.band-gallery-strip-wrapper', goToGallery );

		if ( ! $('body').hasClass( 'page-template-media-php' ) ) {
			lyrics = $('span.lyrics');
			lyrics.each( doWriting );
		}

		window.fbAsyncInit = function() {
			FB.init({
				appId: 142875799055891,
				status: true,
				cookie: true,
				xfbml: true
			});
		};

		(function() {
			var e = document.createElement('script'); e.async = true;
			e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
			document.getElementById('fb-root').appendChild(e);
		}());
    });

}(jQuery));