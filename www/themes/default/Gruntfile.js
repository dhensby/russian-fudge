module.exports = function(grunt) {

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		sass: {
			dist: {
				options: {
					compass: true
				},
				files: {
					'css/main.css': 'scss/main.scss'
				}
			}
		},
		watch: {
			config: {
				files: [ 'Gruntfile.js' ],
				options: {
					reload: true
				}
			},
			sass: {
				tasks: ['sass'],
				files: [
					'scss/*/*.scss',
					'scss/*.scss'
				]
			},
			css: {
				files: [
					'css/*.css'
				],
				options: {
					livereload: true
				}
			},
			templates: {
				files: [
					'templates/*.ss',
					'templates/Layout/*.ss',
					'templates/Includes/*.ss'
				],
				options: {
					livereload: true
				}
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');

	grunt.registerTask('dev', ['sass', 'watch']);
	grunt.registerTask('production', ['sass']);
	grunt.registerTask('default', ['sass']);

};
