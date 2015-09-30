module.service('claimsEditSrv', function($http) {
  var apiPath = '/admin/claims/';

  var self = this;

  this.getClaimsList = function(row, numRows) {
    return $http.get(apiPath + row + '/' + numRows)
      .then(function(response) {
        self.claimsList = response.data.Claims;
        self.claimsCount = response.data.ClaimsCount[0].rowCount;
      });
  };

  this.getClaimDetail = function(object) {
    return $http.get(apiPath + object.id)
      .then(function(response) {
        if (response.data.Claim) {
          
          self.claimDetail = response.data.Claim;
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

    var requestPath;
    if (!copiedObject.id) {
      requestPath = apiPath + '0';
    } else {
      requestPath = apiPath + copiedObject.id;
    }
    var data = {};
    data.Claim = copiedObject;
    data.FORM_SECURITY_TOKEN = formToken;
    return $http({
      method: 'POST',
      url: requestPath,
      data: data,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    }).then(function(response) {
      self.claimDetail = response.data.Claim[0];
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


});
