module.service('staffListSrv', function($http, searchSrv, crudSrv) {

    var apiPath = '/admin/staff/';

    var self = this;

    self.advancedSearch = {};

    this.getStaffList = function(row, numRows) {
        return $http.get(apiPath + row + '/' + numRows)
            .then(function(response) {
                self.staffList = response.data.Staffs;
                self.staffCount = response.data.StaffsCount[0].rowCount;
            });
    };

    this.getStaffDetail = function(object) {
        return $http.get(apiPath + object.id)
            .then(function(response) {
                if (response.data.Staff.dob) {
                    response.data.Staff.dob = new Date(response.data.Staff.dob);
                }
                if (response.data.Staff.hireDate) {
                    response.data.Staff.hireDate = new Date(response.data.Staff.hireDate);
                }
                if (response.data.Staff.departureDate) {
                    response.data.Staff.departureDate = new Date(response.data.Staff.departureDate);
                }
                self.staffDetail = response.data.Staff;
            });
    };

    this.fetchAutocomplete = function(searchObject) {
        return searchSrv.fetchAutocomplete(apiPath, searchObject).then(function() {
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

    this.search = function(searchObject) {
        return searchSrv.search(apiPath, searchObject).then(function() {
            self.searchResults = searchSrv.searchResults.Staffs;
            self.searchResultsCount = searchSrv.searchResultsCount.StaffsCount[0].rowCount;
        });
    };

    this.getAdvancedSearchFilters = function() {
        return searchSrv.getAdvancedSearchFilters('/render/staff/staffAdvancedSearchFilters').then(function() {
            self.advancedSearch.fields = searchSrv.advancedSearch.fields;
        });
    };
    
    this.delete = function(object, formToken) {
        return crudSrv.delete('/admin/staff/remove/', object, formToken);
    };
});