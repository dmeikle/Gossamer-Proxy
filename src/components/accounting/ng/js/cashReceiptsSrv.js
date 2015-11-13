// Inventory service
module.service('cashReceiptsSrv', function ($http, searchSrv, $filter) {
    var apiPath = '/admin/accounting/cashreceipts/';

    var self = this;
    self.error = {};
    self.error.showError = false;

    //Get the list of inventory items
    this.getList = function (row, numRows) {
        return $http.get(apiPath + row + '/' + numRows)
                .then(function (response) {
                    self.list = response.data.AccountingCashReceipts;
                    self.listRowCount = response.data.AccountingCashReceiptsCount[0].rowCount;
                }, function (response) {
                    //Handle any errors
                    self.error.showError = true;
                });
    };
    
    //Search
    this.search = function (searchObject, row, numRows) {
        return $http({
            url: apiPath + row + '/' + numRows + '?name=' + searchObject,
            method: 'GET'
        }).then(function (response) {
            self.searchResults = response.data.AccountingCashReceipts;
            self.searchResultsCount = response.data.AccountingCashReceiptsCount[0].rowCount;
        });
    };
    
    this.advancedSearch = function (searchObject) {
        var config = angular.copy(searchObject);
            config.toDate = $filter('date')(config.toDate, 'yyyy-MM-dd', '+0000');
            config.fromDate = $filter('date')(config.fromDate, 'yyyy-MM-dd', '+0000');
        return $http({
            url: apiPath + 'search/0/20?',
            method: 'GET',
            params: config
        }).then(function (response) {
            self.advancedSearchResults = response.data.PurchaseOrders;
            self.advancedSearchResultsCount = response.data.PurchaseOrdersCount[0].rowCount;
        });
    };
    
    this.getBreakdown = function(id){
        return $http({
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: apiPath + id
        }).then(function (response) {
            self.breakdown = response.data.PurchaseOrder.PurchaseOrder[0];
            self.breakdownLineItems = response.data.PurchaseOrder.PurchaseOrderItems;
        });
    };
});