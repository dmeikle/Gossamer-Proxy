var module = angular.module('dashboardAdmin', ['ui.router']);

module.config(function($stateProvider, $urlRouterProvider) {
  
    // For any unmatched url, redirect to /state1
    $urlRouterProvider.otherwise("/");    
    $stateProvider
    //-----
    //Dashboard
    //-----
    .state('dashboard', {
        url: "/",
        templateUrl: "/render/dashboard/adminDashboard"
    })
    //-----
    //Scoping
    //-----
    .state('scoping', {
        url: "/scoping",
        templateUrl: "/render/scoping/scopingList"
    })
    //-----
    //Claims
    //-----
    .state('claimsList', {
        url: "/claims",
        templateUrl: "/render/claims/admin_claims_home"
    })
    //-----
    //Staff
    //-----
    .state('staff_home', {
        url: "/staff",
        templateUrl: "/render/staff/admin_staff_home"
    })
    //-----
    //Accounting
    //-----
    .state('accounting_generalcosts_home', {
        url: "/accounting/generalcosts",
        templateUrl: "/render/accounting/accounting_generalcosts_home"
    })
    //-----
    //Inventory
    //-----
    .state('inventoryList', {
        url: "/inventory",
        templateUrl: "/render/inventory/admin_inventory_list"
    });
});