"use strict";

/*globals $, jQuery, window, document */

var XHR = (function ($) {

	var REQUEST, CACHE = {};

	function doRequest(href, wrapper, success, error) {	
		if (Object.hasOwnProperty.call(CACHE, href)) {
			wrapper.html(CACHE[href]);
			success();
		} else {
			wrapper.addClass('loading');
			
			if (REQUEST) {
				REQUEST.abort();
			}
			
			REQUEST = $.ajax({
				type    : 'get',
				url     : href,
				success : function (data) {
					wrapper.html(data).removeClass('loading');
					CACHE[href] = data;
					
					success();
				},
				error   : error
			});
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
	
	return {
		doRequest: doRequest,
		ajaxify  : ajaxify
	};
}(jQuery));