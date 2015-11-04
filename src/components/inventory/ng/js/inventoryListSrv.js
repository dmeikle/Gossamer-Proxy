
module.service('inventoryListSrv', function ($http, crudSrv, searchSrv) {
    
    var self = this;
    self.advancedSearch = {};

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


    this.getEquipmentTransferHistory = function(object) {
        var config = {};
        config.InventoryEquipment_id = object.InventoryEquipment_id;
        config['directive::ORDER_BY'] = 'transferDate';
        config['directive::DIRECTION'] = 'desc';
        return searchSrv.searchCall(config, apiPath + 'equipment/transferhistory/0/4');
    };

    this.getMaterialDetails = function(object) {
        return crudSrv.getDetails(apiPath + 'item/', object.id);

    };
    
    this.search = function(object, page, numRows) {
        return searchSrv.search(apiPath, object, page, numRows).then(function() {
            self.searchResults = searchSrv.searchResults.InventoryItems;
            self.searchResultsCount = searchSrv.searchResultsCount.InventoryItemsCount[0].rowCount;
        });
    };

});
