var module = angular.module('scopingAdmin', ['ui.bootstrap', 'dropzone', 'ui.router']);

module.config(function ($httpProvider) {
    $httpProvider.defaults.transformRequest = function (data) {
        if (data === undefined) {
            return data;
        }
        return $.param(data);
    };

});
