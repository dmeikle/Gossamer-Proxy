
var module = angular.module('claimsAdmin', ['ui.bootstrap', 'dropzone']);

module.config(function ($httpProvider) {
    $httpProvider.defaults.transformRequest = function(data){
        if (data === undefined) {
            return data;
        }
        return $.param(data);
    };

});

