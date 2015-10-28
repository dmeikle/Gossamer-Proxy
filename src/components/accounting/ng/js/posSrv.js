// Inventory service
module.service('posSrv', function ($http, searchSrv, $filter) {
    var apiPath = '/admin/accounting/pos/';

    var self = this;

    self.error = {};
    self.error.showError = false;

    //Get the list of inventory items
    this.getList = function (row, numRows) {
        return $http.get(apiPath + row + '/' + numRows)
                .then(function (response) {
                    self.list = response.data.PurchaseOrders;
                    self.listRowCount = response.data.PurchaseOrdersCount[0].rowCount;
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
            self.searchResults = response.data.PurchaseOrders;
            self.searchResultsCount = response.data.PurchaseOrdersCount[0].rowCount;
        });
    };
});