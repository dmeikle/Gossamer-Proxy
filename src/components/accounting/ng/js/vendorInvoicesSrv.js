// Inventory service
module.service('vendorInvoicesSrv', function ($http, searchSrv, $filter) {
    var apiPath = '/admin/accounting/payables/invoices/';
    var vendorsAutocompletePath = '/admin/vendors/autocomplete';
    var subcontractorAutocompletePath = '/admin/subcontractors/autocomplete';
    var breakdownPath = '/admin/accounting/payables/invoices/details/';
    
    var self = this;
    self.error = {};
    self.error.showError = false;

    //Get the list of inventory items
    this.getList = function (row, numRows) {
        return $http.get(apiPath + row + '/' + numRows)
                .then(function (response) {
                    self.list = response.data.VendorInvoices;
                    self.listRowCount = response.data.VendorInvoicesCount[0].rowCount;
                }, function (response) {
                    //Handle any errors
                    self.error.showError = true;
                });
    };
    
    //Search
    this.search = function (searchObject) {
        return $http({
            url: apiPath + '0/20?name=' + searchObject,
            method: 'GET'
        }).then(function (response) {
            self.searchResults = response.data.VendorInvoices;
            self.searchResultsCount = response.data.VendorInvoicesCount[0].rowCount;
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
            self.advancedSearchResults = response.data.VendorInvoices;
            self.advancedSearchResultsCount = response.data.VendorInvoicesCount[0].rowCount;
        });
    };
    
    this.getBreakdown = function(id){
        return $http({
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: breakdownPath + id
        }).then(function (response) {
            self.breakdown = response.data.VendorInvoice[0];
            self.breakdownLineItems = response.data.VendorInvoiceItems;
        });
    };
    
    //Vendor Autocomplete
    this.fetchVendorsAutocomplete = function(searchObject) {
        var config = searchObject;
        //config.action = 'detailed';
        return $http({
            method: 'GET',
            url: vendorsAutocompletePath,
            params: config
        }).then(function(response) {
            self.vendorsAutocompleteValues = response.data.Vendors;
            if (self.vendorsAutocompleteValues.length > 0 && self.vendorsAutocompleteValues[0].length !== 0) {
                return self.vendorsAutocompleteValues;
            } else {
                return undefined;
            }
        });
    };
    
    //Subcontractors Autocomplete
    this.fetchSubcontractorsAutocomplete = function(searchObject) {
        return $http({
            method: 'GET',
            url: subcontractorAutocompletePath,
            params: searchObject
        }).then(function(response) {
            self.subcontractorsAutocompleteValues = response.data.Subcontractors;
            if (self.subcontractorsAutocompleteValues.length > 0) {
                return self.subcontractorsAutocompleteValues;
            } else if (self.subcontractorsAutocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };
});