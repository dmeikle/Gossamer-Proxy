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
    
    //Search
    this.search = function (searchObject) {
        //var config = {};
        return $http({
            url: apiPath + '0/20?name=' + searchObject,
            method: 'GET'
        }).then(function (response) {
            self.searchResults = response.data.InventoryItems;
            self.searchResultsCount = response.data.InventoryItems[0].rowCount;
        });
    };
});