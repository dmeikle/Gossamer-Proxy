// Inventory Modal Service
module.service('vendorInvoicesEditSrv', function ($http, searchSrv, $filter) {
    var apiPath = '/admin/accounting/payablesinvoices/details/';
    var claimsPath = '/admin/claims/';
    var staffAutocompletePath = '/admin/staff/autocomplete';
    var inventoryItemsAutocompletePath = '/admin/inventory/items/autocomplete';
    var vendorItemsAutocompletePath = '/admin/vendors/items/autocomplete';
    var vendorsAutocompletePath = '/admin/vendors/autocomplete';
    var subcontractorAutocompletePath = '/admin/subcontractors/autocomplete';
    var detailsPath = '&action=details';
    var self = this;
    
    //Get the vendor invoice
    this.getVendorInvoice = function (id) {
        return $http({
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: apiPath + id
        }).then(function (response) {
            self.vendorInvoice = response.data.VendorInvoice[0];
            self.vendorInvoiceItems = response.data.VendorInvoiceItems;
//            self.Vendor = response.data.PurchaseOrder.Vendor[0].company;
//            self.VendorLocations = response.data.PurchaseOrder.VendorLocations;
//            self.purchaseOrderNotes = response.data.PurchaseOrder.PurchaseOrderNotes;
//            self.purchaseOrderItems = response.data.PurchaseOrder.PurchaseOrderItems;
            self.vendorInvoice.subtotal = parseFloat(self.vendorInvoice.subtotal);
//            self.purchaseOrder.deliveryFee = parseFloat(self.purchaseOrder.deliveryFee);
            self.vendorInvoice.total = parseFloat(self.vendorInvoice.total);
            self.vendorInvoice.tax = parseFloat(self.vendorInvoice.tax);
            if(self.vendorInvoiceItems.length !== 0){
                for(var i in self.vendorInvoiceItems){
                    self.vendorInvoiceItems[i].quantity = parseFloat(self.vendorInvoiceItems[i].quantity);
                    self.vendorInvoiceItems[i].tax = parseFloat(self.vendorInvoiceItems[i].tax);
                    self.vendorInvoiceItems[i].unitPrice = parseFloat(self.vendorInvoiceItems[i].unitPrice);
                    self.vendorInvoiceItems[i].amount = parseFloat(self.vendorInvoiceItems[i].amount);
                }
            }
            
        });
    };
    
    //Claims Autocomplete
    this.fetchClaimsAutocomplete = function (searchObject) {
        return searchSrv.fetchAutocomplete(claimsPath, searchObject).then(function () {
            self.autocompleteValues = searchSrv.autocomplete.Claims;
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
            url: vendorItemsAutocompletePath,
            params: searchObject
        }).then(function (response) {
//            self.productCodeAutocompleteValues = [];
//            self.productCodeAutocomplete = response.data.VendorItems;
            self.productCodeAutocompleteValues = response.data.VendorItems;
            if (self.productCodeAutocompleteValues.length > 0 && self.productCodeAutocompleteValues[0] !== 'undefined undefined') {
                return self.productCodeAutocompleteValues;
            } else if (self.productCodeAutocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };
    
    //Product Name Autocomplete
    this.fetchProductNameAutocomplete = function (searchObject) {
        return $http({
            method: 'GET',
            url: vendorItemsAutocompletePath,
            params: searchObject
        }).then(function (response) {
//            self.materialsAutocompleteValues = [];
//            self.materialsAutocomplete = response.data.VendorItems;
            self.materialsAutocompleteValues = response.data.VendorItems;
            if (self.materialsAutocompleteValues.length > 0 && self.materialsAutocompleteValues[0] !== 'undefined undefined') {
                return self.materialsAutocompleteValues;
            } else if (self.materialsAutocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };
    
    //Vendor Autocomplete
    this.fetchVendorsAutocomplete = function(searchObject) {
        var config = searchObject;
        //config.action = 'detailed';
        return $http({
            method: 'GET',
            url: vendorsAutocompletePath,
            params: config
        }).then(function(response) {
            self.vendorsAutocompleteValues = response.data.Vendors;
            if (self.vendorsAutocompleteValues.length > 0) {
                return self.vendorsAutocompleteValues;
            } else if (self.vendorsAutocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };
    
    //Subcontractors Autocomplete
    this.fetchSubcontractorsAutocomplete = function(searchObject) {
        return $http({
            method: 'GET',
            url: subcontractorAutocompletePath,
            params: searchObject
        }).then(function(response) {
            self.subcontractorsAutocompleteValues = response.data.Subcontractors;
            if (self.subcontractorsAutocompleteValues.length > 0) {
                return self.subcontractorsAutocompleteValues;
            } else if (self.subcontractorsAutocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };
    
    //Staff Autocomplete
    this.fetchStaffAutocomplete = function (searchObject) {
        return $http({
            method: 'GET',
            url: staffAutocompletePath,
            params: searchObject
        }).then(function(response) {
            self.autocompleteValues = response.data.Staff;
            if (self.autocompleteValues.length > 0 && self.autocompleteValues[0] !== 'undefined undefined') {
                return self.autocompleteValues;
            } else if (self.autocompleteValues[0] === 'undefined undefined') {
                return undefined;
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