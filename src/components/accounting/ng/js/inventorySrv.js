// Inventory service
module.service('inventorySrv', function ($http, searchSrv, $filter) {
    var apiPath = '/admin/accounting/inventory/';

    var self = this;

    self.error = {};
    self.error.showError = false;

    //Get the list of inventory items
    this.getList = function (row, numRows) {
        return $http.get(apiPath + row + '/' + numRows)
                .then(function (response) {
                    self.list = response.data.InventoryItems;
                    self.listRowCount = response.data.InventoryItemsCount[0].rowCount;
                }, function (response) {
                    //Handle any errors
                    self.error.showError = true;
                });
    };

    //Get the breakdown of the selected item
//    this.getBreakdown = function (row, numRows, id) {
//        return $http.get(apiPath + id)
//                .then(function (response) {
//                    self.breakdownItems = response.data.InventoryItems;
//                    self.generalCostsCount = response.data.InventoryItemsCount[0].rowCount;
//                }, function (response) {
//                    //Handle any errors
//                    self.error.showError = true;
//                });
//    };
//
//    this.search = function (searchObject) {
//        var config = {};
//        return $http({
//            url: apiPath + 'search?name=' + searchObject,
//            method: 'GET'
//        }).then(function (response) {
//            self.searchResults = response.data.SuppliesUseds;
//            self.searchResultsCount = response.data.SuppliesUsedsCount[0].rowCount;
//        });
//    };
//
//    this.advancedSearch = function (searchObject) {
//        var config = angular.copy(searchObject);
//        for (var i in config) {
//            if (config[i] === null || config[i] === '') {
//                delete config[i];
//            }
//        }
//        config.toDate = $filter('date')(config.toDate, 'yyyy-MM-dd', '+0000');
//        config.fromDate = $filter('date')(config.fromDate, 'yyyy-MM-dd', '+0000');
//        return $http({
//            url: apiPath + 'search?',
//            method: 'GET',
//            params: config
//        })
//                .then(function (response) {
//                    self.advancedSearchResults = response.data.SuppliesUseds;
//                    self.advancedSearchResultsCount = response.data.SuppliesUsedsCount[0].rowCount;
//                });
//    };
});