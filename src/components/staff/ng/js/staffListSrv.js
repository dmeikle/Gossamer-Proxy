module.service('staffListSrv', function($http, searchSrv) {

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

  this.search = function(searchObject) {
    return searchSrv.search(searchObject, apiPath).then(function() {
      self.searchResults = searchSrv.searchResults;
      self.searchResultsCount = searchSrv.searchResultsCount;
    });
  };

  this.getAdvancedSearchFilters = function() {
    return searchSrv.getAdvancedSearchFilters('/render/staff/staffAdvancedSearchFilters').then(function() {
      self.advancedSearch.fields = searchSrv.advancedSearch.fields;
    });
  };
});
