module.service('crudSrv', function($http) {
  this.save = function(object, objectType, formToken, apiPath) {
    var requestPath;
    if (!object.id) {
      requestPath = apiPath + '0';
    } else {
      requestPath = apiPath + object.id;
    }
    var data = {};
    data[objectType] = object;
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
