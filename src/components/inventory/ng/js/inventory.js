
var module = angular.module('inventoryAdmin', ['ui.bootstrap', 'ui.router']);

module.config(function($httpProvider) {
    $httpProvider.defaults.transformRequest = function(data) {
        if (data === undefined) {
            return data;
        }
        return $.param(data);
    };

});

//module.config(function($stateProvider, $urlRouterProvider) {  
//    $stateProvider
//    .state('inventoryList', {
//        url: "/inventory",
//        templateUrl: "/render/inventory/admin_inventory_list"
//    });
//});