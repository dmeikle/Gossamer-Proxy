module.service('claimsEditSrv', function(crudSrv) {
  var objectType = 'Claim';
  var apiPath = '/admin/claims/';

  this.save = function(object, formToken, page) {
    apiPath = apiPath + page + '/';
    return crudSrv.save(object, objectType, formToken, apiPath).then(function(response) {
      var breakpointme;
    });
  };
});
