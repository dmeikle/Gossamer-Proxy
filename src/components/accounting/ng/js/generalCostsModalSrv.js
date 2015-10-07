// General Costs Modal service
module.service('generalCostsModalSrv', function($http, $filter, searchSrv) {
    var generalCostsPath = '/admin/accounting/generalcosts/';
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
    
    //Save the general cost items
    this.saveGeneralCosts = function(generalCosts, generalCostItems, formToken){
        console.log('saving general cost items...');
        var generalCostID = '';
        if(generalCosts.AccountingGeneralCosts_id){
            generalCostID = parseInt(generalCosts.AccountingGeneralCosts_id);
        } else {
            generalCostID = '0';
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