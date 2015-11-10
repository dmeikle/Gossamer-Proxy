module.service('projectAddressesListSrv', function($http, searchSrv) {

    var apiPath = '/admin/projects/';

    var self = this;

    self.advancedSearch = {};

    this.getList = function(row, numRows) {
        return $http.get(apiPath + row + '/' + numRows)
            .then(function(response) {
                self.projectAddressesList = response.data.ProjectAddresss;
                self.projectAddressesCount = response.data.ProjectAddresss[0].rowCount;
            });
    };

    this.getProjectAddressDetail = function(object) {
        return $http.get(apiPath + object.id)
            .then(function(response) {
                self.projectAddressDetail = response.data.ProjectAddress;
            });
    };

    this.fetchAutocomplete = function(searchObject) {
        return searchSrv.fetchAutocomplete(apiPath, searchObject).then(function() {
            self.autocomplete = searchSrv.autocomplete.ProjectAddresss;
            self.autocompleteValues = [];
            if (searchObject.name) {
                for (var projectAddresses in self.autocomplete) {
                    if (self.autocomplete.hasOwnProperty(projectAddresses) && self.autocomplete.length > 0) {
                        self.autocompleteValues.push(self.autocomplete[projectAddresses].firstname + ' ' + self.autocomplete[projectAddresses].lastname);
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
            self.searchResults = searchSrv.searchResults.ProjectAddresss;
            self.searchResultsCount = searchSrv.searchResultsCount.ProjectAddresssCount[0].rowCount;
        });
    };

    this.getAdvancedSearchFilters = function() {
        return searchSrv.getAdvancedSearchFilters('/render/projects/projectAddressAdvancedSearchFilters').then(function() {
            self.advancedSearch.fields = searchSrv.advancedSearch.fields;
        });
    };
});