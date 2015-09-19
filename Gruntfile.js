module.exports = function(grunt) {

// Load multiple grunt tasks using globbing patterns
require('load-grunt-tasks')(grunt);

// Project configuration.
grunt.initConfig({
  pkg: grunt.file.readJSON('package.json'),

    makepot: {
      target: {
        options: {
          domainPath: '/languages/',    // Where to save the POT file.
          exclude: ['build/.*'],        // Exlude build folder.
          potFilename: 'mina-olen.pot', // Name of the POT file.
          type: 'wp-theme',             // Type of project (wp-plugin or wp-theme).
          updateTimestamp: true,        // Whether the POT-Creation-Date should be updated without other changes.
          processPot: function( pot, options ) {
            pot.headers['report-msgid-bugs-to'] = 'https://foxnet-themes.fi/contact/';
            pot.headers['plural-forms'] = 'nplurals=2; plural=n != 1;';
            pot.headers['last-translator'] = 'WP-Translations (http://wp-translations.org/)\n';
            pot.headers['language-team'] = 'WP-Translations (http://www.transifex.com/projects/p/wp-translations/)\n';
            pot.headers['x-poedit-basepath'] = '..\n';
            pot.headers['x-poedit-language'] = 'English\n';
            pot.headers['x-poedit-country'] = 'UNITED STATES\n';
            pot.headers['x-poedit-sourcecharset'] = 'utf-8\n';
            pot.headers['x-poedit-searchpath-0'] = '.\n';
            pot.headers['x-poedit-keywordslist'] = '__;_e;__ngettext:1,2;_n:1,2;__ngettext_noop:1,2;_n_noop:1,2;_c;_nc:4c,1,2;_x:1,2c;_ex:1,2c;_nx:4c,1,2;_nx_noop:4c,1,2;\n';
            pot.headers['x-textdomain-support'] = 'yes\n';
            return pot;
          }
        }
      }
    },

    exec: {
      txpull: { // Pull Transifex translation - grunt exec:txpull
        cmd: 'tx pull -a --minimum-perc=90' // Change the percentage with --minimum-perc=yourvalue
      },
      txpush_s: { // Push pot to Transifex - grunt exec:txpush_s
        cmd: 'tx push -s'
      },
    },

     dirs: {
    lang: 'languages',
  },


    potomo: {
      dist: {
        options: {
         poDel: false
        },
        files: [{
         expand: true,
         cwd: '<%= dirs.lang %>',
          src: ['*.po'],
          dest: '<%= dirs.lang %>',
         ext: '.mo',
          nonull: true
		}]
		}
	},
	
	// Minify files
	uglify: {
		headroom: {
			files: {
				'js/headroom/headroom.min.js': ['js/headroom/headroom.js'],
				'js/headroom/jQuery.headroom.min.js': ['js/headroom/jQuery.headroom.js']
			}
		},
		fitvids: {
			files: {
				'js/fitvids/fitvids.min.js': ['js/fitvids/fitvids.js']
			}
		},
		settigns: {
			files: {
				'js/settings/setting.min.js': ['js/settings/setting.js']
			}
		},
		skiplink: {
			files: {
				'js/skip-link-focus-fix.min.js': ['js/skip-link-focus-fix.js']
			}
		}
	},
	
	// Minify css
	cssmin : {
		css:{
			src: 'style.css',
			dest: 'style.min.css'
		}
	},

    // Clean up build directory
    clean: {
      main: ['build/<%= pkg.name %>']
    },

    // Copy the theme into the build directory
    copy: {
      main: {
        src:  [
          '**',
          '!node_modules/**',
          '!build/**',
          '!.git/**',
          '!Gruntfile.js',
          '!package.json',
          '!.gitignore',
          '!.gitmodules',
          '!.tx/**',
          '!**/Gruntfile.js',
          '!**/package.json',
          '!**/*~',
		  '!tx.exe'
        ],
        dest: 'build/<%= pkg.name %>/'
      }
    },
	
	// Replace text
	replace: {
		styleVersion: {
			src: [
				'style.css',
			],
			overwrite: true,
			replacements: [ {
				from: /^.*Version:.*$/m,
				to: 'Version: <%= pkg.version %>'
			} ]
		},
		functionsVersion: {
			src: [
				'functions.php'
			],
			overwrite: true,
			replacements: [ {
				from: /^define\( 'MINA_OLEN_VERSION'.*$/m,
				to: 'define( \'MINA_OLEN_VERSION\', \'<%= pkg.version %>\' );'
			} ]
		}
	},

    // Compress build directory into <name>.zip and <name>-<version>.zip
    compress: {
      main: {
        options: {
          mode: 'zip',
          archive: './build/<%= pkg.name %>_v<%= pkg.version %>.zip'
        },
        expand: true,
        cwd: 'build/<%= pkg.name %>/',
        src: ['**/*'],
        dest: '<%= pkg.name %>/'
      }
    },

});

// Default task.
grunt.registerTask( 'default', [ 'uglify', 'cssmin', 'makepot' ] );

// Makepot and push it on Transifex task(s).
grunt.registerTask( 'makandpush', [ 'makepot', 'exec:txpush_s' ] );

// Pull from Transifex and create .mo task(s).
grunt.registerTask( 'tx', [ 'exec:txpull', 'potomo' ] );

// Build task(s).
grunt.registerTask( 'build', [ 'clean', 'replace:styleVersion', 'replace:functionsVersion', 'copy', 'compress' ] );

};