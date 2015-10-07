var module = angular.module('blogsAdmin', ['ui.bootstrap', 'dropzone']);

module.config(function ($httpProvider) {
    $httpProvider.defaults.transformRequest = function(data){
        if (data === undefined) {
            return data;
        }
        return $.param(data);
    };
});