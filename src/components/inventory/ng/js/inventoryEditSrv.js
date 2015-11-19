module.service('inventoryEditSrv', function(crudSrv, searchSrv) {
    var apiPath = '/admin/inventory/items/';
    var objectType = 'InventoryItem';

    var vendorsPath = '/admin/vendors/';
    var vendorsItemListPath = '/admin/inventory/vendorprices/';
    var vendorApiPath = '/admin/inventory/vendoritems/';
    var vendorObjectType = 'VendorItem';
    
    this.getDetails = function (object) {

        return crudSrv.getDetails(apiPath, object.id);
    };

    this.loadVendorPrices = function(id, row, numRows) {
        return crudSrv.getList(vendorApiPath + id + '/', row, numRows);
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
    
    
    this.saveLineItems = function(object, formToken, itemId) {
        var requestPath = vendorsItemListPath + itemId;        
        var lineItemType = 'VendorItem';
        for (var property in object) {
            if (object.hasOwnProperty(property) && !object[property]) {
                delete object[property];
            }
        }

        return crudSrv.save(requestPath, object, lineItemType, formToken);
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
    
    this.fetchVendorsAutocomplete = function (searchObject) {
        return searchSrv.fetchAutocomplete(vendorsPath, searchObject).then(function () {
            self.autocompleteValues = searchSrv.autocomplete.Vendors;            
            if (self.autocompleteValues.length > 0 && self.autocompleteValues[0] !== 'undefined undefined') {
                return self.autocompleteValues;
            } else if (self.autocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };
    
});
