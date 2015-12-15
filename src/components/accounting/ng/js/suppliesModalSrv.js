// General Costs service
module.service('suppliesModalSrv', function ($http, searchSrv, $filter) {
    var apiPath = '/admin/accounting/supplies/';
    var staffPath = '/admin/staff/';
    var claimsPath = '/admin/claims/';
    var materialsPath = '/admin/inventory/materials';
    var inventoryAutocompletePath = '/admin/inventory/items/autocomplete';
//    var claimsLocationsPath = '/admin/claims/locations/';
    var claimsLocationsPath = '/admin/claimlocations/claim/';
    var suppliesUsedPath = '/admin/accounting/suppliesused/';

    var self = this;

    this.getItems = function (row, numRows, id) {
        return $http.get(suppliesUsedPath + id)
                .then(function (response) {
                    self.lineItems = response.data.SuppliesUsedInventoryItems;
                }, function (response) {
                    //Handle any errors
                    self.error.showError = true;
                });
    };

    this.fetchStaffAutocomplete = function (searchObject) {
        return searchSrv.fetchAutocomplete(staffPath, searchObject).then(function () {
            self.autocompleteValues = searchSrv.autocomplete.Staffs;            
            if (self.autocompleteValues.length > 0 && self.autocompleteValues[0] !== 'undefined undefined') {
                return self.autocompleteValues;
            } else if (self.autocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };

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

    this.fetchMaterialNameAutocomplete = function (searchObject) {
        return searchSrv.fetchAutocompleteNoSearch(inventoryAutocompletePath, searchObject).then(function () {
            self.autocompleteValues = searchSrv.autocomplete.InventoryItems;            
            if (self.autocompleteValues.length > 0 && self.autocompleteValues[0] !== 'undefined undefined') {
                return self.autocompleteValues;
            } else if (self.autocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
//        var config = {};
//        config.name = searchObject.name;
//        return $http({
//            method: 'GET',
//            url: autocompletePath,
//            params: config
//        }).then(function (response) {
//            self.materialsAutocompleteValues = [];
//            self.materialsAutocomplete = response.data.InventoryItems;
//            for (var i in response.data.InventoryItems) {
//                self.materialsAutocompleteValues.push(response.data.InventoryItems[i].name);
//            }
//            if (self.materialsAutocompleteValues.length > 0 && self.materialsAutocompleteValues[0] !== 'undefined undefined') {
//                return self.materialsAutocompleteValues;
//            } else if (self.materialsAutocompleteValues[0] === 'undefined undefined') {
//                return undefined;
//            }
//        });
    };

    this.fetchProductCodeAutocomplete = function (searchObject) {
        return searchSrv.fetchAutocompleteNoSearch(inventoryAutocompletePath, searchObject).then(function () {
            self.autocompleteValues = searchSrv.autocomplete.InventoryItems;            
            if (self.autocompleteValues.length > 0 && self.autocompleteValues[0] !== 'undefined undefined') {
                return self.autocompleteValues;
            } else if (self.autocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
//        var config = {};
//        config.productCode = searchObject.productCode;
//        return $http({
//            method: 'GET',
//            url: inventoryAutocompletePath,
//            params: config
//        }).then(function (response) {
//            self.productCodeAutocompleteValues = [];
//            self.productCodeAutocomplete = response.data.InventoryItems;
//            for (var i in response.data.InventoryItems) {
//                self.productCodeAutocompleteValues.push(response.data.InventoryItems[i].productCode);
//            }
//            if (self.productCodeAutocompleteValues.length > 0 && self.productCodeAutocompleteValues[0] !== 'undefined undefined') {
//                return self.productCodeAutocompleteValues;
//            } else if (self.productCodeAutocompleteValues[0] === 'undefined undefined') {
//                return undefined;
//            }
//        });
    };

    this.getClaimsLocations = function (Claims_id) {
        return $http({
            method: 'GET',
            url: claimsLocationsPath + Claims_id
        }).then(function (response) {
            return response.data.ClaimsLocations;
        });
    };

    //Save the supplies used items
    this.save = function (headings, lineItems, formToken) {
        var itemID = '';
        if (headings.id) {
            itemID = parseInt(headings.id);
        } else {
            itemID = '0';
        }

        for (var i in headings) {
            if (headings[i] === null) {
                delete headings[i];
            }
        }
        
        for (i in lineItems) {
            for(var j in lineItems[i]){
                if (lineItems[i][j] === null || lineItems[i][j].length === 0) {
                    delete lineItems[i][j];
                }
            }
        }

        var data = {};
        data.SuppliesUsed = headings;
        data.InventoryItems = lineItems;
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