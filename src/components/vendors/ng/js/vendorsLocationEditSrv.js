module.service('vendorLocationEditSrv', function(crudSrv) {
    var self = this;

    var apiPath = '/admin/vendors/locations/';

    var objectType = 'VendorLocation';

    this.save = function(object, formToken) {
        var requestPath;
        if (!formToken) {
            formToken = object.FORM_SECURITY_TOKEN;
        }
        if (!object.VendorLocations_id) {
            requestPath = apiPath + '0';
        } else {
            requestPath = apiPath + object.VendorLocations_id;
        }
        return crudSrv.save(requestPath, object, objectType, formToken);
    };

    this.delete = function(object, formToken) {
        return crudSrv.save(apiPath + object.id, object, objectType, formToken);
    };
});