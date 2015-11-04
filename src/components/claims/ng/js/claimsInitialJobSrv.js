module.service('claimsInitialJobsheetSrv', function(crudSrv) {
    var apiPathSave = '/admin/claim/initial-jobsheet/save/';
    this.save = function(object, objectType, formToken, ids) {
        return crudSrv.save(apiPathSave + ids, object, objectType, formToken);
    };
});