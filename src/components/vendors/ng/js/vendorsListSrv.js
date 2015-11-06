module.service('vendorsListSrv', function($http, crudSrv, searchSrv) {
    var apiPath = '/admin/vendors/';
    var self = this;
    self.advancedSearch = {};

    this.getVendorsList = function(row, numRows) {
        return crudSrv.getList(apiPath, row, numRows);
    };



    this.search = function(searchObject) {
        return searchSrv.search(apiPath, searchObject).then(function() {
            self.searchResults = searchSrv.searchResults.Vendors;
            self.searchResultsCount = searchSrv.searchResultsCount.VendorsCount[0].rowCount;
        });
    };

    this.getAdvancedSearchFilters = function() {
        return searchSrv.getAdvancedSearchFilters('/render/vendors/vendorAdvancedSearchFilters').then(function() {
            self.advancedSearch.fields = searchSrv.advancedSearch.fields;
        });
    };

    this.getVendorDetails = function(object) {
        return crudSrv.getDetails(apiPath + 'items/', object.id);
    };

    this.getVendorPurchaseOrders = function(vendor, row, numRows) {
        return crudSrv.getList(apiPath + 'purchaseorders/' + vendor.id + '/', row, numRows);
    };

    this.getVendorLocations = function(vendor, row, numRows) {
        return crudSrv.getList(apiPath + 'locations/' + vendor.id + '/', row, numRows);
    };

});