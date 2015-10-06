module.service('claimsInitialJobsheetSrv',function(crudSrv) {
  var apiPathSave = '/admin/claims/initial-jobsheet/save/';
  this.save = function(object, formToken, ids) {
    object.AffectedAreas = Object.keys(object.affectedAreas).map(function(key) {return object.affectedAreas[key];});
    delete object.affectedAreas;
    object.Contacts = Object.keys(object.contacts).map(function(key) {return object.contacts[key];});
    delete object.contacts;

    crudSrv.saveMultiple(object, formToken, apiPath);
  };
});
