/*globals window, document, $, jQuery */

(function ($) {
	"use strict";

	var wrapper,
		bannerItems = [
			'header-1.jpg',
			'header-2.jpg',
			'header-3.jpg',
			'header-4.jpg',
			'header-5.jpg',
			'header-6.jpg',
			'header-7.jpg',
			'header-8.jpg',
			'header-9.jpg',
			'header-10.jpg',
			'header-11.jpg'
		];

	function getBannerIndex() {
		return bannerItems[Math.floor(Math.random() * bannerItems.length)];
	}

	function goToGallery(e) {
		window.location.href = $( e.currentTarget ).closest('.entry-content').prev('h2').find('a').attr('href');
		return false;
	}

    $(document).ready(function () {
		$('.banner').find('img').attr({
			src: ['/wp-content/themes/gp/images/headers/latest/', getBannerIndex()].join('')
		}).parent().find( 'a' ).addClass( 'banner-loaded' );

		wrapper = $('#loop-content');

		$( document.body ).on( 'click', '.gallery-strip-wrapper', goToGallery );

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