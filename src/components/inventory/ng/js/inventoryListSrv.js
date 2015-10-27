module.service('inventoryListSrv', function($http, crudSrv, searchSrv) {
    var apiPath = '/admin/inventory/';

    this.getMaterialsList = function(row, numRows) {
        return crudSrv.getList(apiPath + 'materials/', row, numRows);
    };

    this.getEquipmentList = function(row, numRows) {
        return crudSrv.getList(apiPath + 'equipment/', row, numRows);
    };

    this.getAdvancedSearchFilters = function() {
        return searchSrv.getAdvancedSearchFilters('/render/inventory/inventoryAdvancedSearchFilters').then(function() {
            self.advancedSearch.fields = searchSrv.advancedSearch.fields;
        });
    };

    this.getEquipmentDetails = function(object) {
        return crudSrv.getDetails(apiPath + 'equipment/', object.InventoryEquipment_id);
    };

    this.getMaterialDetails = function(object) {
        return crudSrv.getDetails(apiPath + 'item/', object.id);
    };

});