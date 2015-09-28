module.service('projectAddressesEditSrv', function($http) {
  var apiPath = '/admin/projects/';

  var self = this;

  this.getList = function(row, numRows) {
    return $http.get(apiPath + row + '/' + numRows)
      .then(function(response) {
        self.projectAddressesList = response.data.ProjectAddresses;
        self.projectAddressesCount = response.data.ProjectAddresses[0].rowCount;
      });
  };

  this.getProjectAddressDetail = function(object) {
    return $http.get(apiPath + object.id)
      .then(function(response) {
        if (response.data.ProjectAddress) {          
          self.projectAddress = response.data.ProjectAddress;
        }
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
    data.ProjectAddress = copiedObject;
    data.FORM_SECURITY_TOKEN = formToken;
    return $http({
      method: 'POST',
      url: requestPath,
      data: data,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    }).then(function(response) {
      self.projectAddressDetail = response.data.ProjectAddress[0];
    });
  };


});
