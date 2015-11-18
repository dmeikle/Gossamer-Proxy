// Inventory Modal Service
module.service('cashReceiptsModalSrv', function ($http, searchSrv) {
    var apiPath = '/admin/accounting/cashreceipts/';
    var companiesPath = '/admin/companies/';
    var claimsPath = '/admin/claims/';
    var self = this;


    this.fetchCompanyAutocomplete = function (searchObject) {
        return searchSrv.fetchAutocomplete(companiesPath, searchObject).then(function () {
            self.autocompleteValues = searchSrv.autocomplete.Companys;            
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
    
//    this.fetchInvoiceAutocomplete = function (searchObject) {
//        return searchSrv.fetchAutocomplete(claimsPath, searchObject).then(function () {
//            self.autocompleteValues = searchSrv.autocomplete.Invoices;            
//            if (self.autocompleteValues.length > 0 && self.autocompleteValues[0] !== 'undefined undefined') {
//                return self.autocompleteValues;
//            } else if (self.autocompleteValues[0] === 'undefined undefined') {
//                return undefined;
//            }
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
        data.AccountingCashReceipt = item;
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