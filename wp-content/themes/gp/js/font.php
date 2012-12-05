<?php	 		 		 	 header('Content-Type: application/x-javascript') ?>

WebFontConfig = {
	google: { 
		families: ['Reenie Beanie'] 
	},
 	custom: { 
 		families: ['typey'],
    	urls: [ '<?= urldecode($_GET['ver']) ?>/wp-content/themes/gp/css/local-fonts.css'] 
    }	
};
