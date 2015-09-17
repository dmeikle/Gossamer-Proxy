module.service('companyListSrv', function($http, searchSrv) {

  var apiPath = '/admin/companies/';

  var self = this;

  self.advancedSearch = {};

  this.getCompanyList = function(row, numRows) {
    return $http.get(apiPath + row + '/' + numRows)
      .then(function(response) {
        self.companyList = response.data.Companys;
        self.companyCount = response.data.CompanysCount[0].rowCount;
      });
  };

  this.getCompanyDetail = function(object) {
    return $http.get(apiPath + object.id)
      .then(function(response) {
//        if (response.data.Staff.dob) {
//          response.data.Staff.dob = new Date(response.data.Staff.dob);
//        }
//        if (response.data.Staff.hireDate) {
//          response.data.Staff.hireDate = new Date(response.data.Staff.hireDate);
//        }
//        if (response.data.Staff.departureDate) {
//          response.data.Staff.departureDate = new Date(response.data.Staff.departureDate);
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
