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
    var column = searchObject.col[0];

    return $http.get(apiPath + 'search?' + column + '=' + value)
      .then(function(response) {
        self.autocompleteList = response.data.Staffs;
      });
  };

  this.filterListBy = function(row, numRows, object) {
    var config = {};
    if (object.val[0]) {
      for (var i = 0; i < Object.keys(object.col).length; i++) {
        config[object.col[i]] = object.val[i];
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
});
