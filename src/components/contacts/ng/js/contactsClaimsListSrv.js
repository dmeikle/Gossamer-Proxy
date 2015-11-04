module.service('contactsClaimsListSrv', function($http, searchSrv) {

    var apiPath = '/admin/contacts/claims/';

    var self = this;

    self.advancedSearch = {};

    this.getClaimsList = function(id, row, numRows) {
        return $http.get(apiPath + id)
            .then(function(response) {
                self.claimsList = response.data.Claims;
                //self.claimsCount = response.data.ContactsCount[0].rowCount;
            });
    };

    this.getContactDetail = function(object) {
        return $http.get(apiPath + object.Companies_id)
            .then(function(response) {
                self.contactsDetail = response.data;
            });
    };

    this.search = function(searchObject) {
        return searchSrv.search(apiPath, searchObject).then(function() {
            self.searchResults = searchSrv.searchResults.Contacts;
            self.searchResultsCount = searchSrv.searchResults.ContactsCount[0].rowCount;
        });
    };

    this.getAdvancedSearchFilters = function() {
        return searchSrv.getAdvancedSearchFilters('/render/contacts/contactAdvancedSearchFilters').then(function() {
            self.advancedSearch.fields = searchSrv.advancedSearch.fields;
        });
    };
});