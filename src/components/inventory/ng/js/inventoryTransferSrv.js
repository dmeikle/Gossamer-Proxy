
module.service('inventoryTransferSrv', function($http, searchSrv) {

    var self = this;
    var apiPath = '/admin/inventory/equipment/';

    this.autocomplete = function(value, type, apiPath) {
        var config = {};
        config[type] = value;

        return searchSrv.autocomplete(apiPath, config).then(function(response) {
            var object = {};
            for (var i = response.data.Claims.length - 1; i >= 0; i--) {
                object[response.data.Claims[i][0].jobNumber] = [];
                for(var claimLocation in response.data.Claims[i]) {
                    object[response.data.Claims[i][0].jobNumber].push(response.data.Claims[i][claimLocation]);
                }
            }
            return object;
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