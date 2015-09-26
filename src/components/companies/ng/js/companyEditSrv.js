module.service('companyEditSrv', function($http) {
  var apiPath = '/admin/companies/';

  var self = this;

  this.getCompanyList = function(row, numRows) {
    return $http.get(apiPath + row + '/' + numRows)
      .then(function(response) {
        self.companyList = response.data.Companys;
        self.companyCount = response.data.CompanysCount[0].rowCount;
      });
  };

  this.getCompanyDetail = function(object) {
      console.log(object);
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


  this.save = function(object, formToken) {
    var copiedObject = jQuery.extend(true, {}, object);
    for (var property in copiedObject) {
      if (copiedObject.hasOwnProperty(property)) {
        if (copiedObject[property] === null) {
          delete copiedObject[property];
        }
      }
    }
//    if (copiedObject.dob) {
//      copiedObject.dob = object.dob.toISOString().substring(0, 10);
//    }
//    if (copiedObject.hireDate) {
//      copiedObject.hireDate = object.hireDate.toISOString().substring(0, 10);
//    }
//    if (copiedObject.departureDate) {
//      copiedObject.departureDate = object.departureDate.toISOString().substring(0, 10);
//    }

    var requestPath;
    if (!copiedObject.id) {
      requestPath = apiPath + '0';
    } else {
      requestPath = apiPath + copiedObject.id;
    }
    var data = {};
    data.Company = copiedObject;
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


});
