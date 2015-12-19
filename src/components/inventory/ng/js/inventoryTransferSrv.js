
module.service('inventoryTransferSrv', function($http, searchSrv) {

    var self = this;
    var apiPath = '/admin/inventory/equipment/';

    this.autocomplete = function(value, type, apiPath) {
        var config = {};
        config[type] = value;

        return searchSrv.fetchAutocompleteNoSearch(apiPath, config).then(function(response) {
            var array = [];
            for (var property in response.data) {
                if (property !== 'modules' &&
                property !== 'widgets/admin_claims_autocompletelocations') {
                    response.data[property][0].jobNumber = property;
                    array.push(response.data[property]);
                }
            }
            return array;
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
        config.InventoryEquipment_id = object.id;
        config['directive::ORDER_BY'] = 'transferDate';
        config['directive::DIRECTION'] = 'desc';
        return searchSrv.searchCall(config, apiPath + 'transferhistory/0/10');
    };

});