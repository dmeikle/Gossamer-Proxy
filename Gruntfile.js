module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    clean: ['app/cache/*.cache', 'web/components/*', 'web/assets/css/*'],

    concat: {
      options: {
        separator: '\n'
      },
      dist: {
        expand: true,
        src: ['src/components/*/ng/js/*.js','src/framework/core/components/*/ng/js/*.js'],
        dest: 'src/components/',
        rename: function(dest, src) {
          var srcSplit = src.split('/');
          var componentName = srcSplit[srcSplit.indexOf('components')+1];
          return dest + componentName + '/ng/' + componentName + '.concat.js';
        }
      }
    },

    copy: {
      tempJsCopy: {
        files: [{
          expand: true,
          src: ['src/components/*/ng/*.concat.js','src/framework/core/components/*/ng/*.concat.js'],
          dest: 'web/components/',
          rename: function(dest, src) {
            var srcSplit = src.split('/');
            var componentName = srcSplit[srcSplit.indexOf('components')+1];
            return dest + componentName + '/' + componentName + '.concat.js';
          }
        }],
      }
    },

    jshint: {
      files: ['Gruntfile.js', 'src/components/*/ng/*.concat.js','src/framework/core/components/*/ng/*.concat.js'],
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
      options: {
        style: 'compressed'
      },
      site: {
        files: [{
          expand: true,
          src: ['src/components/*/ng/scss/*.scss','src/framework/core/components/*/ng/scss/*.scss'],
          dest: 'web/assets/css/',
          rename: function(dest, src) {
            var srcSplit = src.split('/');
            var componentName = srcSplit[srcSplit.indexOf('components')+1];
            return dest + componentName + '.min.css';
          }
        }]
      },
      framework: {
        files: [{
          expand: true,
          src: ['src/framework/core/components/*/ng/scss/*.scss','!src/framework/core/components/*/ng/scss/_*.scss'],
          dest: 'web/assets/css/',
          rename: function(dest, src) {
            var srcSplit = src.split('/');
            var componentName = srcSplit[srcSplit.indexOf('components')+1];
            return dest + componentName + '.min.css';
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
          cwd:'src/',
          src: ['components/*/ng/*.concat.js'],
          dest: 'web/components/',
          rename: function(dest, src) {
            var srcSplit = src.split('/');
            var componentName = srcSplit[srcSplit.indexOf('components')+1];
            return dest + componentName + '/' + componentName + '.min.js';
          }
        }
      }
    },

    watch: {
      scripts: {
        files: ['<%= clean %>','<%= jshint.files %>', '<%= sass.framework.files %>','<%= sass.site.files %>','<%= copy.tempJsCopy.files %>'],
        tasks: ['clean', 'jshint', 'sass', 'concat', 'copy']
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
