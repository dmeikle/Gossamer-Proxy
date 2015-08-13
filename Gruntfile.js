module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    clean: ['app/cache/*', 'web/components/*', 'web/assets/css/*'],

    concat: {
      options: {
        separator: '\n'
      },
      dist: {
        expand: true,
        src: ['src/components/*/ng/js/*.js','src/framework/core/components/*/ng/js/*.js'],
        dest: 'web/components/',
        rename: function(dest, src) {
          var srcSplit = src.split('/');
          var componentName = srcSplit[srcSplit.indexOf('components')+1];
          return dest + componentName + '/' + componentName + '.concat.js';
        }
      }
    },

    copy:{
      bower_site: {
        expand:true,
        src: ['src/components/**/ng/bower_components/*'],
        dest: 'web/assets/bower_components/',
        rename: function(dest, src) {
          var srcSplit = src.split('/');
          var component = srcSplit.slice(srcSplit.indexOf('bower_components'), srcSplit.length());
          var componentPath = component.join('/');
          return dest + componentPath;
        }
      },
      bower_framework: {
        expand:true,
        src: ['src/framework/core/components/**/ng/bower_components/**/*'],
        dest: 'web/assets/bower_components/',
        rename: function(dest, src) {
          var srcSplit = src.split('/');
          var component = srcSplit.slice(srcSplit.indexOf('bower_components')+1, srcSplit.length);
          var componentPath = component.join('/');
          return dest + componentPath;
        }
      }
    },

    jshint: {
      files: ['Gruntfile.js', 'web/components/*/*.concat.js'],
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
        files: [{
          expand: true,
          src: ['web/components/**/*.concat.js'],
          dest: 'web/components/',
          rename: function(dest, src) {
            var srcSplit = src.split('/');
            var componentName = srcSplit[srcSplit.indexOf('components')+1];
            return dest + componentName + '/' + componentName + '.min.js';
          }
        }]
      }
    },

    watch: {
      scripts: {
        files: ['<%= jshint.files %>','<%= concat.dist %>'],
        tasks: ['jshint', 'concat']
      },

      sass: {
        files: ['<%= sass.site.files %>','<%= sass.framework.files %>'],
        tasks: ['sass:site','sass:framework'],
        spawn: false
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

  grunt.registerTask('watch', ['watch']);

  grunt.registerTask('test', ['jshint', 'qunit']);

  grunt.registerTask('default', ['concat', 'jshint', 'uglify', 'copy', 'sass']);

  grunt.registerTask('build', ['clean', 'jshint', 'sass', 'concat', 'uglify']);

};
