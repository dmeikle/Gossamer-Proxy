module.service('templateSrv', function() {
  this.staffScheduleModal = '/render/staff/staffScheduleModal';
  this.staffEditModal = '/render/staff/staffEditModal';
});

module.service('staffListSrv', function($http){
  var apiPath = '/admin/staff/';

  var self = this;

  this.getStaffList = function(row, numRows){
    return $http.get(apiPath + row + '/' + numRows)
      .then(function(response){
        self.staffList = response.data.Staffs;
        self.staffCount = response.data.StaffsCount[0].rowCount;
      });
  };

  this.saveStaff = function(staff, formToken) {
    var requestPath;
    if (!staff.id) {
      requestPath = apiPath + '/0';
    } else {
      requestPath = apiPath + '/' + staff.id;
    }
    var data = {};
    data.Widget = staff;
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
    var value = searchObject.val;
    var column = searchObject.col;

    return $http.get(apiPath + 'search?' + column + '=' + value)
    .then(function(response){
      self.autocompleteList = response.data.Staffs;
    });
  };

  this.filterListBy = function(row, numRows, config) {
    return $http.get(apiPath + row + '/' + numRows + '?' + config)
      .then(function(response){
        self.staffList = response.data.Staffs;
        self.staffCount = response.data.StaffsCount[0].rowCount;
      });
  };
});
