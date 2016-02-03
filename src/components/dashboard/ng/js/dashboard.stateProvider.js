var module = angular.module('dashboardAdmin', ['ui.router']);

module.config(["$locationProvider", function($locationProvider) {
//    $locationProvider.html5Mode({
//      enabled: true,
//      requireBase: true
//    });
}]);

module.config(function($stateProvider, $urlRouterProvider, $controllerProvider) {
  
    // For any unmatched url, redirect to /state1
    // $urlRouterProvider.otherwise("/admin/dashboard");
    
    $stateProvider
    .state('dashboard', {
        url: "/admin/dashboard",
        templateUrl: "/render/dashboard/adminDashboard"
    })
    .state('scoping', {
        url: "/admin/scoping",
        templateUrl: "/render/scoping/scopingList"
    })
    .state('claimsList', {
        url: "/admin/claims",
        templateUrl: "/render/claims/admin_claims_home"
    });
});