module.service('inventoryTransferSrv', function($http, crudSrv, searchSrv) {
    var self = this;
    var apiPath = '/admin/inventory/equipment/'

    this.autocomplete = function(value, type, apiPath) {
        var config = {};
        config[type] = value;
        return searchSrv.fetchAutocomplete(config, apiPath).then(function() {
            self.autocompleteResult = searchSrv.autocomplete;
        });
    };

    this.getLocation = function(object) {
        return $http.get('/admin/claims/locations/' + object.WarehouseLocations_id);
    };

    this.transfer = function(object) {

        return $http({
            method: 'POST',
            url: '/admin/inventory/equipment/transfer',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            data: object
        });
    };

    this.getEquipmentTransferHistory = function(object) {
        var config = {};
        config.id = object.id;
        config['directive::ORDER_BY'] = 'transferDate';
        config['directive::DIRECTION'] = 'desc';
        return searchSrv.searchCall(config, apiPath + 'transferhistory/0/4');
    };
});
