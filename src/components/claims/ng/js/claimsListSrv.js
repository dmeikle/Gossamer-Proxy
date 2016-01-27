
module.service('claimsListSrv', function ($http, searchSrv, crudSrv) {


    var apiPath = '/admin/claims/';
    var apiPathClaimLocation = '/admin/claims/locations/claim/';
    var apiPathClaimContacts = '/admin/claim/contacts/';

    var self = this;



    self.advancedSearch = {};

    this.getClaimsList = function(row, numRows) {
        return $http.get(apiPath + row + '/' + numRows);
    };

    this.getClaimDetail = function(object) {
        return $http.get(apiPath + object.id)
            .then(function(response) {
                self.claimDetail = response.data.Claim;
            });
    };


    this.saveProjectManager = function(object, formToken) {
        return crudSrv.save('/admin/claims/projectmanagers/' + object.id, object, 'ProjectManager', formToken).then(function(response) {
            return response.data.Claim[0];
        });
    };

    this.getClaimsLocationsList = function(claimId) {
        return $http.get(apiPath + 'locations/' + claimId)
            .then(function(response) {
                self.claimsLocations = response.data.ClaimsLocations;
            });

    };



    this.getClaimLocations = function(claimId) {
        return $http.get(apiPathClaimLocation + claimId)
            .then(function(response) {
                self.claimsLocations = response.data.ClaimsLocations;
                return response;
            });
    };


    this.getClaimContacts = function(object) {
        return $http.get(apiPathClaimContacts + object.id)
            .then(function(response) {
                self.claimContacts = response.data.ClaimContacts;
            });
    };



    this.fetchAutocomplete = function(searchObject) {
        return searchSrv.fetchAutocomplete(apiPath, searchObject).then(function() {
            self.autocomplete = searchSrv.autocomplete.Claims;
            self.autocompleteCount = searchSrv.autocomplete.ClaimsCount[0].rowCount;
            self.autocompleteValues = [];
            if (searchObject.name) {
                for (var claim in self.autocomplete) {
                    if (self.autocomplete.hasOwnProperty(claim) && self.autocomplete.length > 0) {
                        self.autocompleteValues.push(self.autocomplete[claim].buildingName + ' ' + self.autocomplete[claim].jobNumber);
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

    this.search = function(searchObject) {
        return searchSrv.search(apiPath, searchObject).then(function() {
            self.searchResults = searchSrv.searchResults.Claims;
            self.searchResultsCount = searchSrv.searchResultsCount.ClaimsCount[0].rowCount;
        });
    };

    this.getAdvancedSearchFilters = function() {
        return searchSrv.getAdvancedSearchFilters('/render/claims/advancedSearchFilters').then(function() {
            self.advancedSearch.fields = searchSrv.advancedSearch.fields;
        });
    };
});
