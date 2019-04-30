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

        // PostCSS
        postcss: {
            options: {
                map: true,
                processors: [
                    require('pixrem')(),
                    require('autoprefixer')({
                        browsers: 'last 3 versions'
                    })
                ]
            },
            dist: {
                src: 'style.css'
            }
        },

        // Combine media queries
        cmq: {
            dist: {
                files: {
                    '.': 'style.css'
                }
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

        // Clean
        clean: {
            dist: {
                src: [ 'assets/js/modules/**/*.js' ]
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
                        '!assets/js/vendor/jquery.js',
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
                },
                options: {
                    mangle: true,
                    wrap: true
                },
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
                    '!assets/js/vendor/**/*.js',
                    '!assets/js/modules/*.js',
                    '!assets/js/build.js',
                    '!assets/js/build.min.js'
                ],
                tasks: [ 'coffee', 'concat' ],
                options: {
                    livereload: 35728
                }
            },
            styles: {
                files: [
                    'assets/scss/**/*.scss'
                ],
                tasks: [ 'sass', 'postcss', 'cmq' ],
                options: {
                    livereload: 35729
                }
            },
            options: {
                livereload: true,
                livereloadOnError: false,
                // this blocks time-grunt from displaying
                // https://github.com/sindresorhus/time-grunt/issues/90
                nospawn: true
            }
        },
    });

    grunt.loadNpmTasks('grunt-newer');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-coffee');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-svgmin');
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-combine-media-queries');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-browser-sync');

    // Default task
    grunt.registerTask('default', [ 'sass', 'cmq', 'postcss', 'coffee', 'concat' ]);

    // BrowserSync
    grunt.registerTask('browsersync', [ 'browserSync', 'dev' ]);

    // When you want to optimize img and SVGs
    grunt.registerTask('assets', [ 'svgmin', 'imagemin' ]);

    // Build for distribution (prior to launch)
    // uglify is disabled for now because it's problematic and annoying.
    // grunt.registerTask('build', [ 'default', 'uglify', 'cssmin' ]);
    grunt.registerTask('build', [ 'default', 'cssmin' ]);
};
