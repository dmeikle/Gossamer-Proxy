module.service('staffListSrv', function($http) {
  var apiPath = '/admin/staff/';

  var self = this;

  this.getStaffList = function(row, numRows) {
    return $http.get(apiPath + row + '/' + numRows)
      .then(function(response) {
        self.staffList = response.data.Staffs;
        self.staffCount = response.data.StaffsCount[0].rowCount;
      });
  };

  this.autocomplete = function(searchObject) {
    var value = searchObject.val[0];

    return $http.get(apiPath + 'search?name=' + value)
      .then(function(response) {
        self.autocompleteList = response.data.Staffs;
      });
  };

  this.filterListBy = function(row, numRows, object) {
    var config = {};
    if (object.val[0].length === 1) {
      for (var i = 0; i < Object.keys(object.val).length; i++) {
        config.name = object.val[i];
      }
    } else if (object.val[0].length >= 1) {
      for (var j = 0; j < Object.keys(object.col).length; j++) {
        config[object.col[j]] = object.val[j];
      }
    } else {
      config = undefined;
    }


    return $http({
        url: apiPath + row + '/' + numRows,
        method: 'GET',
        params: config
      })
      .then(function(response) {
        self.searchResults = response.data.Staffs;
        self.searchResultsCount = response.data.StaffsCount[0].rowCount;
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

  this.getAdvancedSearchFilters = function() {
    return $http.get('/render/staff/staffAdvancedSearchFilters').then(function(response) {
      var filters = document.implementation.createHTMLDocument('filters');
      filters.documentElement.innerHTML = response.data;
      self.advancedSearchFilters = filters;
    });
  };
});
