module.service('vendorsListSrv', function ($http, crudSrv, searchSrv) {
    var apiPath = '/admin/vendors/';

    this.getMaterialsList = function (row, numRows) {
        return crudSrv.getList(apiPath + 'materials/', row, numRows);
    };

    this.getEquipmentList = function (row, numRows) {
        return crudSrv.getList(apiPath + 'equipment/', row, numRows);
    };

    this.getAdvancedSearchFilters = function () {
        return searchSrv.getAdvancedSearchFilters('/render/vendors/vendorAdvancedSearchFilters').then(function () {
            self.advancedSearch.fields = searchSrv.advancedSearch.fields;
        });
    };

    this.getEquipmentDetails = function (object) {
        return crudSrv.getDetails(apiPath + 'items/', object.id);
    };

    this.getMaterialDetails = function (object) {
        return crudSrv.getDetails(apiPath + 'items/', object.id);
    };

});
