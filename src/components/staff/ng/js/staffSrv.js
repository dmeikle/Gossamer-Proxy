module.service('templateSrv', function() {
  this.staffScheduleModal = '/render/staff/staffScheduleModal';
  this.staffEditModal = '/render/staff/staffEditModal';
});

module.service('staffSrv', function($http){
  var apiPath = '/admin/staff/';

  var self = this;

  this.getStaffList = function(row, numRows){
    return $http.get(apiPath + row + '/' + numRows)
      .then(function(response){
        self.staffList = response.data.Staffs;
        self.staffCount = response.data.StaffsCount[0].rowCount;
      });
  };

  this.getStaffDetail = function(object) {
    return $http.get(apiPath + object.id)
      .then(function(response) {
        response.data.Staff.dob = new Date(response.data.Staff.dob);
        response.data.Staff.hireDate = new Date(response.data.Staff.hireDate);
        response.data.Staff.departureDate = new Date(response.data.Staff.departureDate);
        self.staffDetail = response.data.Staff;
      });
  };

  this.save = function(object, formToken) {
    var requestPath;
    if (!object.id) {
      requestPath = apiPath + '0';
    } else {
      requestPath = apiPath + object.id;
    }
    var data = {};
    data.Staff = object;
    data.FORM_SECURITY_TOKEN = formToken;
    return $http({
      method: 'POST',
      url: requestPath,
      data: data,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    });
  };

  this.autocomplete = function(searchObject) {
    var value = searchObject.val[0];
    var column = searchObject.col[0];

    return $http.get(apiPath + 'search?' + column + '=' + value)
    .then(function(response){
      self.autocompleteList = response.data.Staffs;
    });
  };

  this.filterListBy = function(row, numRows, searchObject) {
    var config = {};
    if (searchObject.val[0]) {
      for (var i = 0; i < Object.keys(searchObject.col).length; i++) {
        config[searchObject.col[i]] = searchObject.val[i];
      }
    } else {
      config = undefined;
    }


    return $http({
      url: apiPath + row + '/' + numRows,
      method: 'GET',
      params: config
      })
      .then(function(response){
        self.searchResults = response.data.Staffs;
        self.searchResultsCount = response.data.StaffsCount[0].rowCount;
      });
  };
});
