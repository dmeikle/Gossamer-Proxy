module.service('claimsInitialJobsheetSrv',function(crudSrv) {
  var apiPathSave = '/admin/claims/initial-jobsheet/save/';
  this.save = function(object, formToken, ids) {
    if (object.affectedAreas) {
      object.AffectedAreas = Object.keys(object.affectedAreas).map(function(key) {return key;});
      delete object.affectedAreas;
    }
    if (object.contacts) {
      object.Contacts = Object.keys(object.contacts).map(function(key) {return object.contacts[key];});
      delete object.contacts;
    }
    if (object.claimLocation) {
      object.ClaimLocation = object.claimLocation;
      delete object.claimLocation;
    }

    crudSrv.saveMultiple(object, formToken, apiPathSave + ids);
  };
});
