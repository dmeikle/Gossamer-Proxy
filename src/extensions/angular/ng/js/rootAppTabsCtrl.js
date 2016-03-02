module.controller('tabsCtrl', function ($scope, tabsSrv) {
    $scope.tabs = tabsSrv.tabs;

    var defaultTab = {
        title: 'Default',
        template: '',
        content: 'Welcome to Tabbed View. Pages will now load as tabs.'
    };

    if ($scope.tabs.length === 0) {
        $scope.tabs.push(defaultTab);
    }

    $scope.addTab = function (title, template, object, params, defaultTitle) {
        var qs = '';
        if(object !== undefined && params !== undefined) {
            items = params.split(',');
            for(var item in items) {
                if(object.hasOwnProperty(items[item])) {
                   qs += '&' + items[item] + '=' + object[items[item]];
                }
            }
            qs = '?' + qs.slice(1);
        }
        var tabObj = {
            title: (title !== null && title.length > 0) ? title : defaultTitle,
            template: template + qs
        };
        tabsSrv.addTab(tabObj);
//        $scope.tabs = tabsSrv.tabs;
    };

    $scope.closeTab = function (index) {
        tabsSrv.closeTab(index);
        $scope.tabs = tabsSrv.tabs;
    };

    $scope.hideSpinner = function (tab) {
        tab.loading = false;
    };

    $scope.setTabbedView = function (value) {
        tabsSrv.setTabbedView(value);
    };    
    
});