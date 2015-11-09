module.service('subcontractorsClientsListSrv', function($http, searchSrv) {

    var apiPath = '/admin/subcontractors/contacts/';

    var self = this;

    self.advancedSearch = {};

    this.getCompanyClientsList = function(subcontractorsId, row, numRows) {
        return $http.get(apiPath + subcontractorsId)
            .then(function(response) {
                self.subcontractorsClientsList = response.data.Contacts;
                self.subcontractorsClientsCount = response.data.Contacts[0].rowCount;
            });
    };

    this.getCompanyDetail = function(object) {
        return $http.get(apiPath + object.Companies_id)
            .then(function(response) {
                //        if (response.data.Company.dob) {
                //          response.data.Company.dob = new Date(response.data.Company.dob);
                //        }
                //        if (response.data.Company.hireDate) {
                //          response.data.Company.hireDate = new Date(response.data.Company.hireDate);
                //        }
                //        if (response.data.Company.departureDate) {
                //          response.data.Company.departureDate = new Date(response.data.Company.departureDate);
                //        }
                self.subcontractorsDetail = response.data.Company;
            });
    };

    this.search = function(searchObject) {
        return searchSrv.search(apiPath, searchObject).then(function() {
            self.searchResults = searchSrv.searchResults;
            self.searchResultsCount = searchSrv.searchResultsCount;
        });
    };

    this.getAdvancedSearchFilters = function() {
        return searchSrv.getAdvancedSearchFilters('/render/subcontractors/subcontractorsAdvancedSearchFilters').then(function() {
            self.advancedSearch.fields = searchSrv.advancedSearch.fields;
        });
    };
});