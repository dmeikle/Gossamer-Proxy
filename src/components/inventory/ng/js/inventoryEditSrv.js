module.service('inventoryEditSrv', function(crudSrv) {
    var apiPath = '/admin/inventory/items/';
    var objectType = 'InventoryItem';

    this.getDetails = function(object) {
        return crudSrv.getDetails(apiPath, object.id);
    };

    this.save = function(object, formToken) {
        var requestPath;
        if (!object.id || object.id === '') {
            requestPath = apiPath + '0';
        } else {
            requestPath = apiPath + object.id;
        }

        for (var property in object) {
            if (object.hasOwnProperty(property) && !object[property]) {
                delete object[property];
            }
        }

        return crudSrv.save(requestPath, object, objectType, formToken);
    };

    this.delete = function(object, formToken) {
        return crudSrv.delete(apiPath + 'remove/', object, formToken);
    };
});