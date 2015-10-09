module.controller('tabsCtrl', function($scope, tabsSrv) {
    $scope.tabs = tabsSrv.tabs;
//    $scope.tabObj = [{
//        title:'Timesheets',
//        template:'/render/accounting/timesheetsTab',
//        content:'this is a new tabbbb'
//    },{
//        title:'General Costs',
//        template:'/render/accounting/generalCostsTab',
//        content:'tabs? what tabs?'
//    }];
    
//    $scope.timesheetsTab = {
//        title:'Timesheets',
//        template:'/render/accounting/timesheetsTab'
//    };
//    
//    $scope.generalCostsTab = {
//        title:'General Costs',
//        template:'/render/accounting/generalCostsTab'
//    };
//    
//    $scope.staffTimesheetsTab = {
//        title:'Staff Timesheet',
//        template:'/render/staff/staffTimesheetsTab'
//    };
//    
//    $scope.claimsAdminTab = {
//        title:'Claims Admin',
//        template:'/render/claims/claimsAdminTab'
//    };
    
    $scope.addTab = function(title, template){
        var tabObj = {
            title: title,
            template: template
        };
        //Check to see if the tab is already open
        console.log($scope.tabLoading);
        tabsSrv.addTab(tabObj);
        $scope.tabs = tabsSrv.tabs;
    };
    
    $scope.closeTab = function(index){
        tabsSrv.closeTab(index);
        $scope.tabs = tabsSrv.tabs;
    };
    
    $scope.hideSpinner = function(tab){
        tab.loading = false;
    };
    
});