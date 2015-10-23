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
    
    $scope.addTab = function(title, template){
        var tabObj = {
            title: title,
            template: template
        };
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
    
    $scope.setTabbedView = function(value){
        tabsSrv.setTabbedView(value);
    };    
});