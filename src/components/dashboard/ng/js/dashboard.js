
var module = angular.module('dashboardAdmin', ['ui.bootstrap']);

module.config(function($httpProvider) {
    $httpProvider.defaults.transformRequest = function(data) {
        if (data === undefined) {
            return data;
        }
        return $.param(data);
    };

});