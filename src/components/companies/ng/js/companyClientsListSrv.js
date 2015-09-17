module.service('companyClientsListSrv', function($http, searchSrv) {

  var apiPath = '/admin/companies/clients/';

  var self = this;

  self.advancedSearch = {};

  this.getCompanyClientsList = function(companyId, row, numRows) {
    return $http.get(apiPath + companyId + '/' + row + '/' + numRows)
      .then(function(response) {
        self.companyClientsList = response.data.CompanyClients;
        self.companyClientsCount = response.data.CompanyClientsCount[0].rowCount;
      });
  };

  this.getCompanyDetail = function(object) {
    return $http.get(apiPath + object.id)
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
    return searchSrv.search(searchObject, apiPath).then(function() {
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
