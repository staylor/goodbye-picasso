/*globals window, document, $, jQuery */

(function ($) {
	"use strict";

	var wrapper,
		lyrics,
		bannerItems = [2, 4, 6, 7, 9, 10],
		lastXhr,
		cache = {};

	function doRequest(href, success, error) {
		if ( cache[ href ] ) {
			wrapper.html( cache[ href ] );
			success && success();
		} else {
			wrapper.addClass('loading');

			if (lastXhr) {
				lastXhr.abort();
			}

			lastXhr = $.ajax({
				url : href
			}).done(function (data) {
				cache[ href ] = data;
				wrapper.html(data).removeClass('loading');

				success && success();
			}).fail(error);
		}

		return false;
	}

	function ajaxify(item, callback) {
		var href = item.attr('href');

		// TODO: consider Apache rewrites to avoid using query string (which will leverage caching better)
		if (href.indexOf('ajax=1') === -1) {
			item.attr('href', href + (href.indexOf('?') > -1 ? '&ajax=1' : '?ajax=1'));
		}

		item.click(callback);
	}

	window.XHR = {
		doRequest: doRequest,
		ajaxify: ajaxify
	};

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

		$( document.body )
			.on( 'click', '.band-gallery-strip-wrapper', goToGallery )
			.on( 'click', '#nav-above a, #nav-below a', function (e) {
				var href, elem = $( e.currentTarget );

				href = elem.attr('href');
				wrapper = $('#loop-content');
				doRequest(href, function () {
					$('.wp-playlist:not(.ready)').addClass('ready').each(function () {
						return new WPPlaylistView({ el: this });
					});
				});
				return false;
			} );

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