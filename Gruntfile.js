module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    clean: ['src/components/*/dist/*', 'src/framework/core/components/*/dist/*'],

    concat: {
      options: {
        separator: '\n'
      },
      site: {
        expand: true,
        cwd: 'src/components/',
        src: ['*/ng/js/*.js'],
        dest: 'dist/js/',
        rename: function(dest, src, options) {
          var srcSplit = src.split('/');
          var componentName = srcSplit[srcSplit.indexOf('ng')-1];
          return options.cwd + componentName + '/' + dest + componentName + '.concat.js';
        }
      },
      framework: {
        expand:true,
        cwd: 'src/framework/core/components/',
        src:['*/ng/js/*.js'],
        dest: 'dist/js/',
        rename: function(dest, src, options) {
          var srcSplit = src.split('/');
          var componentName = srcSplit[srcSplit.indexOf('ng')-1];
          return options.cwd + componentName + '/' + dest + componentName + '.concat.js';
        }
      }
    },

    copy:{
      bower_site: {
        expand:true,
        cwd: 'src/components/',
        src: ['*/ng/bower_components/**/*'],
        dest: 'dist/bower_components/',
        rename: function(dest, src, options) {
          var srcSplit = src.split('/');
          var component = srcSplit.slice(srcSplit.indexOf('bower_components')+1, srcSplit.length);
          var componentName = srcSplit[srcSplit.indexOf('ng')-1];
          var componentPath = component.join('/');
          return options.cwd + componentName + '/' + dest + '/' + componentPath;
        }
      },
      bower_framework: {
        expand:true,
        cwd: 'src/framework/core/components/',
        src: ['*/ng/bower_components/**/*'],
        dest: 'dist/bower_components',
        rename: function(dest, src, options) {
          var srcSplit = src.split('/');
          var component = srcSplit.slice(srcSplit.indexOf('bower_components')+1, srcSplit.length);
          var componentName = srcSplit[srcSplit.indexOf('ng')-1];
          var componentPath = component.join('/');
          return options.cwd + componentName + '/' + dest + '/' + componentPath;
        }
      }
    },

    jshint: {
      files: ['Gruntfile.js', 'src/components/*/dist/js/*.concat.js','src/framework/core/components/*/dist/js/*.concat.js'],
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
          cwd: 'src/components/',
          src: ['*/ng/scss/*.scss', '!*/ng/scss/_*.scss'],
          dest: 'dist/css/',
          rename: function(dest, src, options) {
            var srcSplit = src.split('/');
            var componentName = srcSplit[srcSplit.indexOf('ng')-1];
            return options.cwd + componentName + '/' + dest + componentName + '.min.css';
          }
        }]
      },
      framework: {
        files: [{
          expand: true,
          cwd: 'src/framework/core/components/',
          src: ['*/ng/scss/*.scss', '!*/ng/scss/_*.scss'],
          dest: 'dist/css/',
          rename: function(dest, src, options) {
            var srcSplit = src.split('/');
            var componentName = srcSplit[srcSplit.indexOf('ng')-1];
            return options.cwd + componentName + '/' + dest + componentName + '.min.css';
          }
        }]
      },
      theme: {
        files: {
          'web/css/core.min.css':'src/themes/default/core.scss'
        }
      }
    },

    uglify: {
      options: {
        sourceMap: true
      },
      site: {
        files: [{
          expand: true,
          cwd: 'src/components/',
          src: ['*/dist/js/*.concat.js'],
          dest: 'dist/js/',
          rename: function(dest, src, options) {
            var srcSplit = src.split('/');
            var componentName = srcSplit[srcSplit.indexOf('dist')-1];
            grunt.log.write(options.cwd + componentName + '/' + dest + componentName + '.min.js');
            return options.cwd + componentName + '/' + dest + componentName + '.min.js';
          }
        }]
      },
      framework: {
        files: [{
          expand:true,
          cwd: 'src/framework/core/components/',
          src: ['*/dist/js/*.concat.js'],
          dest: 'dist/js/',
          rename: function(dest, src, options) {
            var srcSplit = src.split('/');
            var componentName = srcSplit[srcSplit.indexOf('dist')-1];
            grunt.log.write(options.cwd + componentName + '/' + dest + componentName + '.min.js');
            return options.cwd + componentName + '/' + dest + componentName + '.min.js';
          }
        }]
      }
    },

    watch:{
      concat_site: {
        files: ['src/components/*/ng/js/*.js'],
        tasks: ['concat:site']
      },

      concat_framework:{
        files:['src/framework/core/components/*/ng/js/*.js'],
        tasks: ['concat:framework']
      },

      jshint: {
        files: ['<%= jshint.files %>'],
        tasks: ['jshint']
      },

      uglify_site: {
        files: ['src/components/*/dist/js/*.concat.js'],
        tasks: ['uglify:site']
      },

      uglify_framework: {
        files: ['src/framework/core/components/*/dist/js/*.concat.js'],
        tasks: ['uglify:framework']
      },

      sass_site: {
        files: ['src/components/*/ng/scss/*.scss', '!src/components/*/ng/scss/_*.scss'],
        tasks: ['sass:site'],
        spawn: false
      },

      sass_framework: {
        files: ['src/framework/core/components/*/ng/scss/*.scss', '!src/framework/core/components/*/ng/scss/_*.scss'],
        tasks: ['sass:framework'],
        spawn:false
      },

      sass_theme: {
        files: ['src/themes/default/core.scss', 'src/themes/default/styles/*.scss'],
        tasks: ['sass:theme'],
        spawn:false
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

  // grunt.registerTask('watch', ['watch']);

  grunt.registerTask('test', ['jshint', 'qunit']);

  grunt.registerTask('default', ['clean','concat', 'jshint', 'uglify', 'copy', 'sass']);

  grunt.registerTask('build', ['clean', 'jshint', 'sass', 'concat', 'uglify']);

};
