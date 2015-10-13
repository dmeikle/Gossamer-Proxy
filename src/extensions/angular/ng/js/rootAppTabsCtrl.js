module.controller('tabsCtrl', function($scope, tabsSrv) {
    $scope.tabs = tabsSrv.tabs;
    
    var defaultTab = {
        title:'Default',
        template:'',
        content:'Welcome to Tabbed View. Pages will now load as tabs.'
    };
    if($scope.tabs.length === 0){
        $scope.tabs.push(defaultTab);
    }
//    $scope.tabObj = [{
//        title:'Timesheets',
//        template:'/render/accounting/timesheetsTab',
//        content:'this is a new tabbbb'
//    },{
//        title:'General Costs',
//        template:'/render/accounting/generalCostsTab',
//        content:'tabs? what tabs?'
//    }];
    
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