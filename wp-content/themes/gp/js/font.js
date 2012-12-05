"use strict";

/*globals window, WebFontConfig */

var WebFontConfig = {
	google : { 
		families: ['Reenie Beanie'] 
	},
	custom: {
		families: ['typey'],
		urls: [window.navigator.appName.toLowerCase().indexOf('microsoft') > -1 ? 'http://goodbyepicasso.com/wp-content/themes/gp/css/local-fonts-ie.css' : 'http://goodbyepicasso.com/wp-content/themes/gp/css/local-fonts.css']
	}
};