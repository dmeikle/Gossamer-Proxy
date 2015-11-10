module.service('inventoryEditSrv', function(crudSrv) {
    var apiPath = '/admin/inventory/items/';
    var objectType = 'InventoryItem';

    var vendorApiPath = '/admin/inventory/vendoritems/';
    var vendorObjectType = 'VendorItem';
    
    this.getDetails = function (object) {

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


    this.saveVendorItem = function (object, formToken) {
        var requestPath;
        if (!object.id || object.id === '') {
            requestPath = vendorApiPath + '0';
        } else {
            requestPath = vendorApiPath + object.id;
        }

        for (var property in object) {
            if (object.hasOwnProperty(property) && !object[property]) {
                delete object[property];
            }
        }

        return crudSrv.save(object, vendorObjectType, formToken, requestPath);
    };

    this.delete = function (object, formToken) {

        return crudSrv.delete(apiPath + 'remove/', object, formToken);
    };
});
