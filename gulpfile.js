var gulp = require( 'gulp' ),
	watchers = require( './gulp/watchers' );

gulp.task( 'sass-pipeline', require( './gulp/sass' ) );

gulp.task( 'default', function () {
	watchers();
} );