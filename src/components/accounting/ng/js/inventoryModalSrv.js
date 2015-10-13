// General Costs service
module.service('inventoryModalSrv', function($http, searchSrv, $filter) {
    var apiPath = '/admin/accounting/inventory/';
    var staffPath = '/admin/staff/';
    var claimsPath = '/admin/claims/';
    var materialsPath = '/admin/inventory/materials';
    
    
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
    
    this.fetchMaterialsAutocomplete = function(searchObject) {
        console.log('Service materials autocomplete...');
        console.log(searchObject);
        var config = {};
        config.name = searchObject.name;
        return searchSrv.fetchAutocomplete(config, materialsPath + '/0/20').then(function() {
            
            //Once inventory search has been implemented, check the results for null and undefined
            console.log(searchSrv.autocomplete);
//            self.autocomplete = searchSrv.autocomplete.Claims;
//            self.autocompleteValues = [];
//            for (var item in self.autocomplete) {
//                if (!isNaN(item/1)) {
//                    self.autocompleteValues.push(self.autocomplete[item].jobNumber);
//                }
//            }
//            if (self.autocompleteValues.length > 0 && self.autocompleteValues[0] !== 'undefined undefined') {
//                return self.autocompleteValues;
//            } else if (self.autocompleteValues[0] === 'undefined undefined') {
//                return undefined;
//            }
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