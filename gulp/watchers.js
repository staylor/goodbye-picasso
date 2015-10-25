var gulp = require( 'gulp' );

module.exports = function () {
	var watchers = [
		gulp.watch(
			[ './wp-content/themes/gp/scss/**/*.scss' ],
			[ 'sass-pipeline' ]
		)
	];

	watchers.forEach( function ( watcher ) {
		watcher.on( 'change', function ( event ) {
			console.log( 'File ' + event.path + ' was ' + event.type + ', running tasks...' );
		});
	} );
};