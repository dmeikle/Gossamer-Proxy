module.service('tabsSrv', function ($http, $window) {
    var apiPath = '/admin/tabbedview/set';
    this.tabs = [];

    //Adding a tab
    this.addTab = function (tabObj) {
        tabObj.active = true;
        //Checks to see if the tab is already opened...
        for (var i in this.tabs) {
            this.tabs[i].active = false;
            if (this.tabs[i].title === tabObj.title) {
                this.tabs[i].active = true;
                return;
            }
        }
        //set the loading key to show the spinner
        tabObj.loading = true;
        this.tabs.push(tabObj);
    };

    //Closing a tab
    this.closeTab = function (index) {
        this.tabs.splice(index, 1);
    };

    //setting tab preference
    this.setTabbedView = function (value) {
        var config = {};
        config.view = value;
        return $http({
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: apiPath,
            data: config
                    //params: config
        })
                .then(function (response) {
                    console.log(response);
                    $window.location.href = response.data.redirect;
                });
    };

//this.advancedSearch = function(searchObject) {
//        var config = angular.copy(searchObject);
//        config.toDate = $filter('date')(config.toDate, 'yyyy-MM-dd', '+0000');
//        config.fromDate = $filter('date')(config.fromDate, 'yyyy-MM-dd', '+0000');
//        return $http({
//            url: apiPath + 'search?',
//            method: 'GET',
//            params: config
//        })
//        .then(function(response) {
//            self.advancedSearchResults = response.data.AccountingGeneralCosts;
//            self.advancedSearchResultsCount = response.data.AccountingGeneralCostsCount[0].rowCount;
//        });
//    };
});