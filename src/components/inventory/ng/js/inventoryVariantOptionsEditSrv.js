module.service('variantOptionsEditSrv', function(crudSrv, searchSrv) {
    var self = this;


    this.getDetails = function(apiPath, object) {
        return crudSrv.getDetails(apiPath, object.id);
    };

    this.save = function(apiPath, object, formToken) {
        var requestPath;
        if (!object.id || object.id === '') {
            requestPath = apiPath + '0';
        } else {
            requestPath = apiPath + object.id;
        }

        for (var property in object) {
            if (object.hasOwnProperty(property) && !object[property]) {
                delete object[property];
            }
        }

        return crudSrv.save(object, objectType, formToken, requestPath);
    };

    this.delete = function(apiPath, object, formToken) {
        return crudSrv.delete(apiPath + 'remove/', object, formToken);
    };
});