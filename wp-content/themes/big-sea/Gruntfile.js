/*global module:false*/
module.exports = function(grunt) {
    require('time-grunt')(grunt);
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        // Sass / Scss
        sass: {
            dist: {
                options: {
                    loadPath: [
                        'node_modules'
                    ],
                    require: [
                        'sass-globbing',
                        'bourbon'
                    ],
                    style: 'expanded',
                    lineNumbers: false
                },
                files: [{
                    expand: true,
                    flatten: true,
                    cwd: 'assets/scss',
                    src: [
                        '**/*.scss'
                    ],
                    dest: '.',
                    ext: '.css'
                }]
            }
        },

        // CSSMin
        cssmin: {
            dist: {
                files: {
                    'style.min.css': [
                        'style.css'
                    ]
                }
            }
        },

        // Coffeescript
        coffee: {
            dist: {
                files: [{
                    expand: true,
                    flatten: true,
                    cwd: 'assets/coffee',
                    src: ['**/*.coffee'],
                    dest: 'assets/js/modules',
                    ext: '.js'
                }]
            }
        },

        // Imagemin
        imagemin: {
            dist: {
                options: {
                    optimizationLevel: 3
                },
                files: [{
                    expand: true,
                    flatten: true,
                    cwd: 'assets/images/src',
                    src: [
                        '**/*.png',
                        '**/*.jpg',
                        '**/*.gif'
                    ],
                    dest: 'assets/images'
                }]
            }
        },

        // SVG Minification
        svgmin: {
            dist: {
                options: {
                    plugins: [
                        { removeViewBox: false },
                        { removeUselessStrokeAndFill: true },
                        { removeEmptyAttrs: true }
                    ]
                },
                files: [{
                    expand: true,
                    cwd: 'assets/images/src/svg',
                    src: [ '**/*.svg' ],
                    dest: 'assets/images'
                }]
            }
        },

        // Concatenation
        concat: {
            dist: {
                files: {
                    'assets/js/build.js': [
                        'assets/js/vendor/**/*.js',
                        'assets/js/modules/**/*.js',
                        '!assets/js/build.js',
                        '!assets/js/build.min.js'
                    ]
                },
                options: {
                    separator: ';'
                }
            }
        },

        // Uglify
        uglify: {
            dist: {
                files: {
                    'assets/js/build.min.js': [
                        'assets/js/build.js',
                        '!assets/js/build.min.js'
                    ]
                }
            }
        },

        // Browsersync
        browserSync: {
            dist: {
                files: {
                    src: [
                        'assets/coffee/**/*.coffee',
                        'assets/js/**/*.js',
                        'assets/scss/**/*.scss',
                        '*.html',
                        '*.php',
                        '*.twig'
                    ]
                },
                options: {
                    port: '<%= pkg.browsersync_port %>',
                    open: 'ui',
                    watchTask: true,
                    injectChanges: true
                }
            }
        },

        // Watch
        watch: {
            scripts: {
                files: [
                    'assets/coffee/**/*.coffee',
                    'assets/js/**/*.js',
                    '!assets/js/modules/*.js',
                    '!assets/js/build.js',
                    '!assets/js/build.min.js'
                ],
                tasks: [
                    'coffee',
                    'concat'
                ]
            },
            styles: {
                files: [
                    'assets/scss/**/*.scss'
                ],
                tasks: [
                    'sass'
                ]
            },
            options: {
                livereload: true
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-coffee');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-svgmin');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-browser-sync');

    // Default task
    grunt.registerTask('default', [ 'sass', 'coffee', 'concat' ]);

    // When you want BrowserSync
    grunt.registerTask('dev', [ 'browserSync', 'watch' ]);

    // When you want to optimize img and SVGs
    grunt.registerTask('assets', [ 'svgmin', 'imagemin' ]);

    // Build for distribution (prior to launch)
    grunt.registerTask('build', [ 'default', 'uglify', 'cssmin' ]);
};
