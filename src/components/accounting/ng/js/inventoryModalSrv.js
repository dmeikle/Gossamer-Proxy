// General Costs service
module.service('inventoryModalSrv', function($http, searchSrv, $filter) {
    var apiPath = '/admin/accounting/inventory/';
    var staffPath = '/admin/staff/';
    var claimsPath = '/admin/claims/';
    var materialsPath = '/admin/inventory/materials';
    var autocompletePath = '/admin/inventory/items/autocomplete';
    
    var self = this;
    
    this.fetchAutocomplete = function(searchObject) {
        return searchSrv.fetchAutocomplete(searchObject, staffPath).then(function() {
            self.autocomplete = searchSrv.autocomplete.Staffs;
            self.autocompleteValues = [];
            if (searchObject.name) {
                for (var staff in self.autocomplete) {
                    if (self.autocomplete.hasOwnProperty(staff) && self.autocomplete.length > 0) {
                        self.autocompleteValues.push(self.autocomplete[staff].firstname + ' ' + self.autocomplete[staff].lastname);
                    }
                }
            }
            if (self.autocompleteValues.length > 0 && self.autocompleteValues[0] !== 'undefined undefined') {
                return self.autocompleteValues;
            } else if (self.autocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };
    
    this.fetchClaimsAutocomplete = function(searchObject) {
        console.log(searchObject);
        return searchSrv.fetchAutocomplete(searchObject, claimsPath).then(function() {
            console.log(searchSrv.autocomplete);
            self.claimsAutocomplete = searchSrv.autocomplete.Claims;
            self.claimsAutocompleteValues = [];
            console.log(self.claimsAutocomplete);
            for (var item in self.claimsAutocomplete) {
                if (!isNaN(item/1)) {
                    self.claimsAutocompleteValues.push(self.claimsAutocomplete[item].jobNumber);
                }
            }
            if (self.claimsAutocompleteValues.length > 0 && self.claimsAutocompleteValues[0] !== 'undefined undefined') {
                return self.claimsAutocompleteValues;
            } else if (self.claimsAutocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };
    
    this.fetchMaterialNameAutocomplete = function(searchObject) {
        var config = {};
        config.name = searchObject.name;        
        return $http({
            method: 'GET',
            url: autocompletePath,
            params: config
        }).then(function(response) {
            self.materialsAutocompleteValues = [];
            self.materialsAutocomplete = response.data.InventoryItems;
            for(var i in response.data.InventoryItems){
                self.materialsAutocompleteValues.push(response.data.InventoryItems[i].name);
            }
            if (self.materialsAutocompleteValues.length > 0 && self.materialsAutocompleteValues[0] !== 'undefined undefined') {
                return self.materialsAutocompleteValues;
            } else if (self.materialsAutocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };
    
    this.fetchProductCodeAutocomplete = function(searchObject) {
        var config = {};
        config.productCode = searchObject.productCode;        
        return $http({
            method: 'GET',
            url: autocompletePath,
            params: config
        }).then(function(response) {
            self.productCodeAutocompleteValues = [];
            self.productCodeAutocomplete = response.data.InventoryItems;
            for(var i in response.data.InventoryItems){
                self.productCodeAutocompleteValues.push(response.data.InventoryItems[i].productCode);
            }
            if (self.productCodeAutocompleteValues.length > 0 && self.productCodeAutocompleteValues[0] !== 'undefined undefined') {
                return self.productCodeAutocompleteValues;
            } else if (self.productCodeAutocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };
    //Get the list of general cost items
//    this.getItems = function(row, numRows, id){
//        return $http.get(generalCostItemsPath + row + '/' + numRows + '/?AccountingGeneralCosts_id=' + id)
//            .then(function(response) {
//            self.generalCostItems = response.data.AccountingGeneralCostItems;
//            self.generalCostsCount = response.data.AccountingGeneralCostItemsCount[0].rowCount;
//        }, function(response){
//            //Handle any errors
//            self.error.showError = true;
//        });
//    };
    
    //Save the general cost items
    this.save = function(headings, lineItems, formToken){
        console.log('saving inventory items...');
        var itemID = '';
        if(headings.id){
            itemID = parseInt(headings.id);
        } else {
            itemID = '0';
        }
        
        //Loop through the objects and delete any null values
//        for(var i in generalCosts){
//            if(generalCosts[i] === null){
//                delete generalCosts[i];
//            }
//        }
//        
//        for(var j in generalCostItems){
//            for(var p in generalCostItems[j]){
//                if(generalCostItems[j][p] === null){
//                    console.log(p + ' is null!');
//                    delete generalCostItems[j][p];
//                }
//            }
//        }

//        var data = {};
//        data.GeneralCost = generalCosts;
//        data.AccountingGeneralCostItems = generalCostItems;
//        data.FORM_SECURITY_TOKEN = formToken;
//        
//        console.log(data);
//        
//        return $http({
//            method: 'POST',
//            headers: {
//                'Content-Type': 'application/x-www-form-urlencoded'
//            },
//            url: generalCostsPath + generalCostID,
//            data: data
//        }).then(function(response) {
//            console.log(response);
//        });
    };
});