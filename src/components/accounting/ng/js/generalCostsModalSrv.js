// General Costs Modal service
module.service('generalCostsModalSrv', function($http, $filter, searchSrv) {
    var generalCostsPath = '/admin/accounting/generalcosts/';
    var generalCostItemsPath = '/admin/accounting/generalcostitems/';
    var staffPath = '/admin/staff/';
    var claimsPath = '/admin/claims/';
    //Typeahead autocomplete
    var self = this;
    
    this.fetchAutocomplete = function(searchObject) {
        console.log('fetching typeahead autocomplete...');
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
        return searchSrv.fetchAutocomplete(searchObject, claimsPath).then(function() {
            self.autocomplete = searchSrv.autocomplete;
            self.autocompleteValues = [];
            for (var item in self.autocomplete) {
                if (!isNaN(item/1)) {
                    self.autocompleteValues.push(self.autocomplete[item].label);
                }
            }
            if (self.autocompleteValues.length > 0 && self.autocompleteValues[0] !== 'undefined undefined') {
                return self.autocompleteValues;
            } else if (self.autocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };
    
    //Get the list of general cost items
    this.getGeneralCostItems = function(row, numRows, id){
        return $http.get(generalCostItemsPath + row + '/' + numRows + '/?AccountingGeneralCosts_id=' + id)
            .then(function(response) {
            self.generalCostItems = response.data.AccountingGeneralCostItems;
            self.generalCostsCount = response.data.AccountingGeneralCostItemsCount[0].rowCount;
        }, function(response){
            //Handle any errors
            self.error.showError = true;
        });
    };
    
    //Save the general cost items
    this.saveGeneralCosts = function(generalCosts, generalCostItems, formToken){
        console.log('saving general cost items...');
        var generalCostID = '';
        if(generalCosts.id){
            generalCostID = parseInt(generalCosts.id);
        } else {
            generalCostID = '0';
        }
        
        //Loop through the objects and delete any null values
        for(var i in generalCosts){
            if(generalCosts[i] === null){
                delete generalCosts[i];
            }
        }
        
        for(var j in generalCostItems){
            for(var p in generalCostItems[j]){
                if(generalCostItems[j][p] === null){
                    console.log(p + ' is null!');
                    delete generalCostItems[j][p];
                }
            }
        }

        var data = {};
        data.GeneralCost = generalCosts;
        data.AccountingGeneralCostItems = generalCostItems;
        data.FORM_SECURITY_TOKEN = formToken;
        
        console.log(data);
        
        return $http({
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: generalCostsPath + generalCostID,
            data: data
        }).then(function(response) {
            console.log(response);
        });
    };
});