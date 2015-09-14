module.service('staffEditSrv', function($http) {
  var apiPath = '/admin/staff/';

  var self = this;

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

  this.getStaffCreds = function(object) {
    return $http.get(apiPath + 'credentials/' + object.id)
      .then(function(response) {
        self.staffCreds = response.data.StaffAuthorization;
      });
  };

  this.save = function(object, formToken) {
    var copiedObject = jQuery.extend(true, {}, object);
    for (var property in copiedObject) {
      if (copiedObject.hasOwnProperty(property)) {
        if (copiedObject[property] === null) {
          delete copiedObject[property];
        }
      }
    }
    if (copiedObject.dob) {
      copiedObject.dob = object.dob.toISOString().substring(0, 10);
    }
    if (copiedObject.hireDate) {
      copiedObject.hireDate = object.hireDate.toISOString().substring(0, 10);
    }
    if (copiedObject.departureDate) {
      copiedObject.departureDate = object.departureDate.toISOString().substring(0, 10);
    }

    var requestPath;
    if (!copiedObject.id) {
      requestPath = apiPath + '0';
    } else {
      requestPath = apiPath + copiedObject.id;
    }
    var data = {};
    data.Staff = copiedObject;
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

  this.checkUsernameExists = function(object) {
    return $http({
        url: apiPath + 'checkusername/' + object.id + '/' + object.username,
        method: 'GET'
      })
      .then(function(response) {
        self.usernameExists = response.data.exists;
      });
  };

  this.saveCredentials = function(object, formToken) {
    var data = {};
    data.StaffAuthorization = object;
    data.FORM_SECURITY_TOKEN = formToken;
    return $http({
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      url: apiPath + 'credentials/' + object.id,
      data: data
    }).then(function(response) {
      self.credentialStatus = response.data;
    });
  };


});
