// Inventory service
module.service('cashReceiptsSrv', function ($http, searchSrv, $filter, crudSrv) {
    var apiPath = '/admin/accounting/cashreceipts/';
    var companiesPath = '/admin/companies/';
    var claimsPath = '/admin/claims/';
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
            //url: apiPath + row + '/' + numRows + '?name=' + searchObject,
            url: apiPath + 'search?name=' + searchObject,
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
            url: apiPath + 'search',
            method: 'GET',
            params: config
        }).then(function (response) {
            self.advancedSearchResults = response.data.AccountingCashReceipts;
            self.advancedSearchResultsCount = response.data.AccountingCashReceiptsCount[0].rowCount;
        });
    };
    
    this.fetchCompanyAutocomplete = function (searchObject) {
        return searchSrv.fetchAutocomplete(companiesPath, searchObject).then(function () {
            self.autocompleteValues = searchSrv.autocomplete.Companys;            
            if (self.autocompleteValues.length > 0 && self.autocompleteValues[0] !== 'undefined undefined') {
                return self.autocompleteValues;
            } else if (self.autocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };
    
    this.fetchClaimsAutocomplete = function (searchObject) {
        return searchSrv.fetchAutocomplete(claimsPath, searchObject).then(function () {
            self.autocompleteValues = searchSrv.autocomplete.Claims;            
            if (self.autocompleteValues.length > 0 && self.autocompleteValues[0] !== 'undefined undefined') {
                return self.autocompleteValues;
            } else if (self.autocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
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
            //self.breakdown = response.data.PurchaseOrder.PurchaseOrder[0];
            self.breakdown = response;
            //self.breakdownLineItems = response.data.PurchaseOrder.PurchaseOrderItems;
        });
    };
    
    this.saveItem = function(item, formToken){
        return crudSrv.save(apiPath + item.id, item, 'CashReceipt', formToken);
    };
});