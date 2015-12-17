module.service('contactsListSrv', function($http, searchSrv, crudSrv) {

    var apiPath = '/admin/contacts/';

    var self = this;

    self.advancedSearch = {};

    this.getContactList = function(row, numRows) {
        return $http.get(apiPath + row + '/' + numRows)
            .then(function(response) {
                self.contactsList = response.data.Contacts;
                self.contactsCount = response.data.ContactsCount[0].rowCount;
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
    
    
    this.delete = function(object, formToken) {
        return crudSrv.delete('/admin/contacts/', object, formToken);
    };
});