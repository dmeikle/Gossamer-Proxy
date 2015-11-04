module.service('inventoryEquipmentEditSrv', function(crudSrv) {
    var apiPath = '/admin/inventory/equipment/';
    var objectType = 'InventoryItem';

    this.getDetails = function(object) {
        return crudSrv.getDetails(apiPath + 'get/', object.id);
    };

    this.save = function(object, formToken) {
        var requestPath;
        if (!object.id || object.id === '') {
            requestPath = apiPath + '0';
        } else {
            requestPath = apiPath + object.InventoryEquipment_id;
        }

        for (var property in object) {
            if (object.hasOwnProperty(property) && !object[property]) {
                delete object[property];
            }
        }

        return crudSrv.save(object, objectType, formToken, requestPath);
    };

    this.delete = function(object, formToken) {
        return crudSrv.delete(apiPath + 'remove/', object, formToken);
    };
});