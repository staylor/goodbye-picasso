var gulp = require( 'gulp' ),
	gutil = require( 'gulp-util' ),
	rename = require( 'gulp-rename' ),
	postcss = require( 'gulp-postcss' ),
	sass = require( 'gulp-sass' ),
	autoprefixer = require( 'autoprefixer' ),
	mqpacker = require( 'css-mqpacker' ),
	csswring = require( 'csswring' ),
	Q = require( 'q' ),

	c = require( './color-log' ),

	processors = [
		autoprefixer({
			browsers: [
				'Android >= 2.1',
				'Chrome >= 21',
				'Explorer >= 7',
				'Firefox >= 17',
				'Opera >= 12.1',
				'Safari >= 6.0'
			],
			cascade: false
		}),
		mqpacker
	],

	SRC = './wp-content/themes/gp/scss',
	DEST = './wp-content/themes/gp/css';

module.exports = function () {
	var stream, deferred = Q.defer();

	gutil.log( 'Compiling SCSS templates ...' );

	stream = gulp.src( SRC + '/*.scss' )
		.pipe( sass( {
			outputStyle: 'expanded'
		} ).on( 'error', sass.logError ) )
		.pipe( postcss( processors ) )
		.pipe( gulp.dest( DEST ) )
		.on( 'end', function () {
			gutil.log( 'Running', c( 'PostCSS' ) , 'tasks...' );
		})
		.pipe( postcss( [ csswring ] ) )
		.pipe( rename({ extname: '.min.css' }) )
		.pipe( gulp.dest( DEST ) )
		.on( 'end', function () {
			gutil.log( 'Saved to', c( DEST ) );
		} );

	stream.on( 'end', function () {
		deferred.resolve();
	} );

	return deferred.promise;
};