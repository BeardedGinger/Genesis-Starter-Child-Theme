'use strict';
module.exports = function(grunt) {

    require('load-grunt-tasks')(grunt);

    grunt.initConfig({

        // watch our project for changes
        watch: {
            compass: {
				files: ['assets/**/*.{scss,sass}'],
                tasks: ['compass']
            },
            livereload: {
                options: { livereload: true },
                files: ['scss/**/*.{scss,sass}','stylesheets/master.css', '**/*.html', '**/*.php', 'images/**/*.{png,jpg,jpeg,gif,webp,svg}']
            }
        },

        compass: {
     		dist: {
                options: {
                    config: 'config.rb',
                    force: true
                }
            }
        },

		// concatenation and minification all in one
		uglify: {
		    plugins: {
		        options: {
		            sourceMap: 'js/plugins.js.map',
		            sourceMappingURL: 'plugins.js.map',
		            sourceMapPrefix: 2
		        },
		       	files: {
		            'js/plugins.min.js': [
		             	'assets/js/scripts.js',
						'assets/js/mobile-nav.js'
			            ]
				}
			}
		}

	});

    // register task
    grunt.registerTask('default', ['watch']);

};