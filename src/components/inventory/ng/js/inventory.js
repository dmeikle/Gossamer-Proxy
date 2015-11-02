
var module = angular.module('inventoryAdmin', ['ui.bootstrap']);

module.config(function($httpProvider) {
    $httpProvider.defaults.transformRequest = function(data) {
        if (data === undefined) {
            return data;
        }
        return $.param(data);
    };

});
