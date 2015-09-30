module.service('claimsEditSrv', function(crudSrv, searchSrv) {
  var objectType = 'Claim';
  var apiPath = '/admin/claims/';
  var apiPathSingle = '/admin/claim/';

  this.save = function(object, formToken, page) {
    apiPath = apiPath + page + '/';
    return crudSrv.save(object, objectType, formToken, apiPathSingle);
  };

  this.autocomplete = function(value, type) {
    var config = {};
    config[type] = value;
    return searchSrv.fetchAutocomplete(config, apiPath + 'projectaddresses/').then(function() {
      return searchSrv.autocomplete.ProjectAddresss;
    });
  };
});