module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    clean: ['src/components/*/dist/*', 'app/framework/core/components/*/dist/*', 'src/extensions/*/dist/*'],

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
        cwd: 'app/framework/core/components/',
        src:['*/ng/js/*.js'],
        dest: 'dist/js/',
        rename: function(dest, src, options) {
          var srcSplit = src.split('/');
          var componentName = srcSplit[srcSplit.indexOf('ng')-1];
          return options.cwd + componentName + '/' + dest + componentName + '.concat.js';
        }
      },
      extensions: {
        expand:true,
        cwd: 'src/extensions/',
        src:['*/ng/js/*.js'],
        dest: 'dist/js/',
        rename: function(dest, src, options) {
          var srcSplit = src.split('/');
          var componentName = srcSplit[srcSplit.indexOf('ng')-1];
          return options.cwd + componentName + '/' + dest + componentName + '-extension.concat.js';
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
        cwd: 'app/framework/core/components/',
        src: ['*/ng/bower_components/**/*'],
        dest: 'dist/bower_components',
        rename: function(dest, src, options) {
          var srcSplit = src.split('/');
          var component = srcSplit.slice(srcSplit.indexOf('bower_components')+1, srcSplit.length);
          var componentName = srcSplit[srcSplit.indexOf('ng')-1];
          var componentPath = component.join('/');
          return options.cwd + componentName + '/' + dest + '/' + componentPath;
        }
      },
      bower_extensions: {
        expand:true,
        cwd: 'src/extensions/',
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
      files: ['Gruntfile.js', 'src/components/*/dist/js/*.concat.js',
      'app/framework/core/components/*/dist/js/*.concat.js',
      'src/extensions/*/dist/js/*.concat.js'],
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
        outputStyle: 'compressed',
        sourceMap: true
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
          cwd: 'app/framework/core/components/',
          src: ['*/ng/scss/*.scss', '!*/ng/scss/_*.scss'],
          dest: 'dist/css/',
          rename: function(dest, src, options) {
            var srcSplit = src.split('/');
            var componentName = srcSplit[srcSplit.indexOf('ng')-1];
            return options.cwd + componentName + '/' + dest + componentName + '.min.css';
          }
        }]
      },
      extensions: {
        files: [{
          expand: true,
          cwd: 'src/extensions/',
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
        sourceMap: true,
        mangle: false
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
            grunt.log.write(options.cwd + componentName + '/' + dest + componentName + ".min.js\r\n");
            return options.cwd + componentName + '/' + dest + componentName + '.min.js';
          }
        }]
      },
      framework: {
        files: [{
          expand:true,
          cwd: 'app/framework/core/components/',
          src: ['*/dist/js/*.concat.js'],
          dest: 'dist/js/',
          rename: function(dest, src, options) {
            var srcSplit = src.split('/');
            var componentName = srcSplit[srcSplit.indexOf('dist')-1];
            grunt.log.write(options.cwd + componentName + '/' + dest + componentName + ".min.js\r\n");
            return options.cwd + componentName + '/' + dest + componentName + '.min.js';
          }
        }]
      },
      extensions: {
        files: [{
          expand:true,
          cwd: 'src/extensions/',
          src: ['*/dist/js/*.concat.js'],
          dest: 'dist/js/',
          rename: function(dest, src, options) {
            var srcSplit = src.split('/');
            var componentName = srcSplit[srcSplit.indexOf('dist')-1];
            grunt.log.write(options.cwd + componentName + '/' + dest + componentName + '-extension.min.js' + "\r\n");
            return options.cwd + componentName + '/' + dest + componentName + '-extension.min.js';
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
        files:['app/framework/core/components/*/ng/js/*.js'],
        tasks: ['concat:framework']
      },

      concat_extensions:{
        files:['src/extensions/*/ng/js/*.js'],
        tasks: ['concat:extensions']
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
        files: ['app/framework/core/components/*/dist/js/*.concat.js'],
        tasks: ['uglify:framework']
      },

      uglify_extensions: {
        files: ['src/extensions/*/dist/js/*.concat.js'],
        tasks: ['uglify:extensions']
      },

      sass_site: {
        files: ['src/components/*/ng/scss/*.scss', '!src/components/*/ng/scss/_*.scss'],
        tasks: ['sass:site'],
        spawn: false
      },

      sass_framework: {
        files: ['app/framework/core/components/*/ng/scss/*.scss', '!app/framework/core/components/*/ng/scss/_*.scss'],
        tasks: ['sass:framework'],
        spawn:false
      },

      sass_extensions: {
        files: ['src/extensions/*/ng/scss/*.scss', '!src/extensions/*/ng/scss/_*.scss'],
        tasks: ['sass:extensions'],
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
  grunt.loadNpmTasks('grunt-sass');

  grunt.registerTask('test', ['jshint', 'qunit']);

  grunt.registerTask('default', ['build','watch'] );

  grunt.registerTask('build', ['clean','concat', 'jshint', 'uglify', 'copy', 'sass']);

};
