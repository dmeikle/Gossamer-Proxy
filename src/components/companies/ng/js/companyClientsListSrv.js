module.service('companyClientsListSrv', function($http, searchSrv) {

    var apiPath = '/admin/companies/contacts/';

    var self = this;

    self.advancedSearch = {};

    this.getCompanyClientsList = function(companyId, row, numRows) {
        return $http.get(apiPath + companyId)
            .then(function(response) {
                self.companyClientsList = response.data.Contacts;
                self.companyClientsCount = response.data.Contacts[0].rowCount;
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
                self.companyDetail = response.data.Company;
            });
    };

    this.search = function(searchObject) {
        return searchSrv.search(apiPath, searchObject).then(function() {
            self.searchResults = searchSrv.searchResults;
            self.searchResultsCount = searchSrv.searchResultsCount;
        });
    };

    this.getAdvancedSearchFilters = function() {
        return searchSrv.getAdvancedSearchFilters('/render/companies/companyAdvancedSearchFilters').then(function() {
            self.advancedSearch.fields = searchSrv.advancedSearch.fields;
        });
    };
});