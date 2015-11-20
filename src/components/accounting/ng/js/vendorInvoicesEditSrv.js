// Inventory Modal Service
module.service('vendorInvoicesEditSrv', function ($http, searchSrv, $filter) {
    var apiPath = '/admin/accounting/invoices/';
    var claimsPath = '/admin/claims/';
    var inventoryItemsAutocompletePath = '/admin/inventory/items/autocomplete';
    var vendorsAutocompletePath = '/admin/vendors/autocomplete';
    //var vendorsAutocompletePath = '/admin/vendors/autocomplete';
    var self = this;
    
    //Claims Autocomplete
    this.fetchClaimsAutocomplete = function (searchObject) {
        console.log(searchObject);
        return searchSrv.fetchAutocomplete(claimsPath, searchObject).then(function () {
            self.autocomplete = searchSrv.autocomplete.Claims;
            self.autocompleteValues = [];
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
        return $http({
            method: 'GET',
            url: inventoryItemsAutocompletePath,
            params: searchObject
        }).then(function (response) {
            self.productCodeAutocompleteValues = [];
            self.productCodeAutocomplete = response.data.InventoryItems;
            self.productCodeAutocompleteValues = response.data.InventoryItems;
            if (self.productCodeAutocompleteValues.length > 0 && self.productCodeAutocompleteValues[0] !== 'undefined undefined') {
                return self.productCodeAutocompleteValues;
            } else if (self.productCodeAutocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };
    
    //Product Name Autocomplete
    this.fetchProductNameAutocomplete = function (searchObject) {
        //var config = {};
        //config.name = searchObject.name;
        return $http({
            method: 'GET',
            url: inventoryItemsAutocompletePath,
            params: searchObject
        }).then(function (response) {
            self.materialsAutocompleteValues = [];
            self.materialsAutocomplete = response.data.InventoryItems;
            self.materialsAutocompleteValues = response.data.InventoryItems;
//            for (var i in response.data.InventoryItems) {
//                self.materialsAutocompleteValues.push(response.data.InventoryItems[i].name);
//            }
            if (self.materialsAutocompleteValues.length > 0 && self.materialsAutocompleteValues[0] !== 'undefined undefined') {
                return self.materialsAutocompleteValues;
            } else if (self.materialsAutocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };
    
    //Vendor Autocomplete
    this.fetchVendorsAutocomplete = function(searchObject) {
        return $http({
            method: 'GET',
            url: vendorsAutocompletePath,
            params: searchObject
        }).then(function(response) {
            self.vendorsAutocompleteValues = [];
            self.vendorKeys = Object.keys(response.data.Vendors[0]);
            
            
            for(var i in self.vendorKeys){
                var obj = {};
                obj.company = self.vendorKeys[i];
                obj.locations = response.data.Vendors[0][self.vendorKeys[i]];
                self.vendorsAutocompleteValues.push(obj);
            }
            if (self.vendorsAutocompleteValues.length > 0) {
                return self.vendorsAutocompleteValues;
            } else if (self.vendorsAutocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };
    
    //Get the purchase order
    this.getPurchaseOrder = function (id) {
        return $http({
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: apiPath + id
        }).then(function (response) {
            self.purchaseOrder = response.data.PurchaseOrder.PurchaseOrder[0];
            self.Vendor = response.data.PurchaseOrder.Vendor[0].company;
            self.VendorLocations = response.data.PurchaseOrder.VendorLocations;
            self.purchaseOrderNotes = response.data.PurchaseOrder.PurchaseOrderNotes;
            self.purchaseOrderItems = response.data.PurchaseOrder.PurchaseOrderItems;
            self.purchaseOrder.subtotal = parseFloat(self.purchaseOrder.subtotal);
            self.purchaseOrder.deliveryFee = parseFloat(self.purchaseOrder.deliveryFee);
            self.purchaseOrder.total = parseFloat(self.purchaseOrder.total);
            self.purchaseOrder.tax = parseFloat(self.purchaseOrder.tax);
            if(self.purchaseOrderItems[0].length !== 0){
                for(var i in self.purchaseOrderItems){
                    self.purchaseOrderItems[i].quantity = parseFloat(self.purchaseOrderItems[i].quantity);
                    self.purchaseOrderItems[i].tax = parseFloat(self.purchaseOrderItems[i].tax);
                    self.purchaseOrderItems[i].unitPrice = parseFloat(self.purchaseOrderItems[i].unitPrice);
                    self.purchaseOrderItems[i].amount = parseFloat(self.purchaseOrderItems[i].amount);
                }
            }
            
        });
    };
    
    //Save the purchase order
    this.save = function (item, lineItems, formToken) {
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
        
        for (i in lineItems) {
            for (var j in lineItems[i]){                
                if (lineItems[i][j] === null) {
                    delete lineItems[i][j];
                }
            }
        }
        var data = {};
        data.VendorInvoice = item;
        data.VendorInvoiceItems = lineItems;
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