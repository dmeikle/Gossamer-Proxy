module.service('claimsEditSrv', function() {
  this.save = function(object, formToken) {
    var requestPath;
    if (!copiedObject.id) {
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
    }).then(function(response) {
      self.staffDetail = response.data.Staff[0];
    });
  };
});
