module.service('claimsEditSrv', function(crudSrv, searchSrv) {
  var objectType = 'Claim';
  var apiPath = '/admin/claims/';
  var singleApiPath = '/admin/claim/';

  this.save = function(object, formToken, page) {
    var requestPath = singleApiPath + page + '/';
    var copiedObject = angular.copy(object);
    copiedObject.date = object.date.toISOString().substring(0, 10);
    return crudSrv.save(copiedObject, objectType, formToken, requestPath);
  };

  this.getClaimDetails = function(id) {
    return crudSrv.getDetails(apiPath, id).then(function(response) {
      var breakpoint;
    });
  };

  this.autocomplete = function(value, type) {
    var config = {};
    config[type] = value;
    return searchSrv.fetchAutocomplete(config, apiPath + 'projectaddresses/').then(function() {
      return searchSrv.autocomplete.ProjectAddresss;
    });
  };

  this.saveProjectAddress = function(object, formToken) {
    return crudSrv.save(object, 'ProjectAddress', formToken, '/admin/projects/');
  };
});
