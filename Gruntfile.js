module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    clean: ['app/cache/*.cache'],

    concat: {
      options: {
        separator: '\n'
      },
      dist: {
        expand: true,
        cwd: 'src/components/',
        src: ['**/ng/js/*.js'],
        dest: 'web/components/',
        rename: function(dest, src) {
          var componentName = src.substring(0, src.indexOf('/'));
          return dest + componentName + '/' + componentName + '.concat.js';
        }
      }
    },

    copy: {
      html: {
        files: [{
          expand: true,
          cwd: 'src/components/',
          src: ['**/ng/view/*.html'],
          dest: 'web/components/',
          rename: function(dest, src) {
            var componentName = src.substring(0, src.indexOf('/'));
            return dest + componentName + '/' + componentName + '.html';
          }
        }],
      },

      tempJsCopy: {
        files: [{
          expand: true,
          cwd: 'src/components/',
          src: ['**/ng/view/*.concat.js'],
          dest: 'web/components/',
          rename: function(dest, src) {
            var componentName = src.substring(0, src.indexOf('/'));
            return dest + componentName + '/' + componentName + '.concat.js';
          }
        }],
      }
    },

    jshint: {
      files: ['Gruntfile.js', 'src/components/**/ng/**/*.js'],
      options: {
        // options here to override JSHint defaults
        globals: {
          jQuery: true,
          console: true,
          module: true,
          document: true
        }
      }
    },

    sass: {
      dist: {
        options: {
          style: 'compressed'
        },
        files: [{
          expand: true,
          cwd: 'src/components/',
          src: ['**/ng/scss/*.scss'],
          dest: 'web/components/',
          rename: function(dest, src) {
            var componentName = src.substring(0, src.indexOf('/'));
            return dest + componentName + '/' + componentName + '.min.css';
          }
        }]
      }
    },

    uglify: {
      options: {
        sourceMap: true
      },
      dist: {
        files: {
          expand: true,
          cwd:'src/components/',
          src: ['**/ng/*.concat.js'],
          dest: 'web/components/',
          rename: function(dest, src) {
            var componentName = src.substring(0, src.indexOf('/'));
            return dest + componentName + '/' + componentName + '.min.js';
          }
        }
      }
    },

    watch: {
      scripts: {
        files: ['<%= jshint.files %>'],
        tasks: ['jshint', 'concat:dist']
      },

      sass: {
        options: { spawn: false },
        files: ['<%= sass.dist.files %>'],
        tasks: ['sass:dist']
      },

      html: {
        files: ['<%= copy.main.files %>'],
        tasks: ['copy:main']
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-debug-task');

  grunt.registerTask('test', ['jshint', 'qunit']);

  grunt.registerTask('default', ['clean', 'jshint', 'sass', 'concat', 'copy']);

  grunt.registerTask('build', ['clean', 'jshint', 'sass', 'concat', 'uglify', 'copy']);

};
