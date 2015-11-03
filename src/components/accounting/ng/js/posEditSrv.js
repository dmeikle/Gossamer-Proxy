// Inventory Modal Service
module.service('posEditSrv', function ($http, searchSrv, $filter) {
    var apiPath = '/admin/accounting/pos/';
    var claimsPath = '/admin/claims/';
    var inventoryItemsAutocompletePath = '/admin/inventory/items/autocomplete';
    //var inventoryItemsPath = ''
    var self = this;
    
    //Claims Autocomplete
    this.fetchClaimsAutocomplete = function (searchObject) {
        return searchSrv.fetchAutocomplete(searchObject, claimsPath).then(function () {
            self.autocomplete = searchSrv.autocomplete.Claims;
            self.autocompleteValues = [];
            console.log(searchSrv.autocomplete);
            for (var item in self.autocomplete) {
                if (!isNaN(item / 1)) {
                    self.autocompleteValues.push(self.autocomplete[item].jobNumber);
                }
            }
            if (self.autocompleteValues.length > 0 && self.autocompleteValues[0] !== 'undefined undefined') {
                return self.autocompleteValues;
            } else if (self.autocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };
    
    //Product Code Autocomplete
    this.fetchProductCodeAutocomplete = function (searchObject) {
        var config = {};
        config.productCode = searchObject.productCode;
        return $http({
            method: 'GET',
            url: inventoryItemsAutocompletePath,
            params: config
        }).then(function (response) {
            self.productCodeAutocompleteValues = [];
            self.productCodeAutocomplete = response.data.InventoryItems;
            for (var i in response.data.InventoryItems) {
                
                self.productCodeAutocompleteValues.push(response.data.InventoryItems[i].productCode);
            }
            if (self.productCodeAutocompleteValues.length > 0 && self.productCodeAutocompleteValues[0] !== 'undefined undefined') {
                return self.productCodeAutocompleteValues;
            } else if (self.productCodeAutocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };
    
    //Product Name Autocomplete
    this.fetchProductNameAutocomplete = function (searchObject) {
        var config = {};
        config.name = searchObject.name;
        return $http({
            method: 'GET',
            url: inventoryItemsAutocompletePath,
            params: config
        }).then(function (response) {
            self.materialsAutocompleteValues = [];
            self.materialsAutocomplete = response.data.InventoryItems;
            for (var i in response.data.InventoryItems) {
                self.materialsAutocompleteValues.push(response.data.InventoryItems[i].name);
            }
            if (self.materialsAutocompleteValues.length > 0 && self.materialsAutocompleteValues[0] !== 'undefined undefined') {
                return self.materialsAutocompleteValues;
            } else if (self.materialsAutocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };
    
    //Get the purchase order
    this.getPurchaseOrder = function (id) {
        //var config = {};

        return $http({
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: apiPath + id,
            //config: config
        }).then(function (response) {
            console.log(response);
            self.purchaseOrder = response.data.PurchaseOrder;
            self.purchaseOrder.subtotal = parseFloat(self.purchaseOrder.subtotal);
            self.purchaseOrder.deliveryFee = parseFloat(self.purchaseOrder.deliveryFee);
            self.purchaseOrder.total = parseFloat(self.purchaseOrder.total);
            self.purchaseOrder.tax = parseFloat(self.purchaseOrder.tax);
            
            for(var i in self.purchaseOrder.PurchaseOrderItem){
                self.purchaseOrder.PurchaseOrderItem[i].quantity = parseFloat(self.purchaseOrder.PurchaseOrderItem[i].quantity);
                self.purchaseOrder.PurchaseOrderItem[i].tax = parseFloat(self.purchaseOrder.PurchaseOrderItem[i].tax);
                self.purchaseOrder.PurchaseOrderItem[i].unitPrice = parseFloat(self.purchaseOrder.PurchaseOrderItem[i].unitPrice);
                self.purchaseOrder.PurchaseOrderItem[i].amount = parseFloat(self.purchaseOrder.PurchaseOrderItem[i].amount);
            }
        });
    };
    
//    this.getInventoryItemDetails = function(id){
//        return $http({
//            method: 'GET',
//            headers: {
//                'Content-Type': 'application/x-www-form-urlencoded'
//            },
//            url: inventoryItemsAutocompletePath + '?id=' + id,
//        }).then(function (response) {
//            self.inventoryItemDetails = response.data.InventoryItems;
//        });
//    };
    
    //Save the inventory item
    this.save = function (item, formToken) {
        var itemID = '';
        if (item.id) {
            itemID = parseInt(item.id);
        } else {
            itemID = '0';
        }

        for (var i in item) {
            if (item[i] === null) {
                delete item[i];
            }
        }

        var data = {};
        data.InventoryItem = item;
        data.FORM_SECURITY_TOKEN = formToken;

        return $http({
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: apiPath + itemID,
            data: data
        }).then(function (response) {
            //console.log(response);
        });
    };
    
});