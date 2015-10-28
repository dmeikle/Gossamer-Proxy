module.service('vendorsListSrv', function ($http, crudSrv, searchSrv) {
    var apiPath = '/admin/vendors/';

    this.getVendorsList = function (row, numRows) {
        return crudSrv.getList(apiPath, row, numRows);
    };


    this.getAdvancedSearchFilters = function () {
        return searchSrv.getAdvancedSearchFilters('/render/vendors/vendorAdvancedSearchFilters').then(function () {
            self.advancedSearch.fields = searchSrv.advancedSearch.fields;
        });
    };

    this.getVendorDetails = function (object) {
        return crudSrv.getDetails(apiPath + 'items/', object.id);
    };

});
