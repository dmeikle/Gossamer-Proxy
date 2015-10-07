module.service('claimsInitialJobsheetSrv',function(crudSrv) {
  var apiPathSave = '/admin/claims/initial-jobsheet/save/';
  this.save = function(object, objectType, formToken, ids) {
    crudSrv.save(object, objectType, formToken, apiPathSave + ids);
  };
});
