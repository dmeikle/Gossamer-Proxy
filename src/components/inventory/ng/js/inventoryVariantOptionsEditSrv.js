module.service('variantOptionsEditSrv', function(crudSrv, searchSrv) {
    var self = this;

    var objectType = 'VariantOption';

    this.getDetails = function(apiPath, object) {
        return crudSrv.getDetails(apiPath, object.id).then(function(response) {
            response.data.VariantOption[0].locale = response.data.VariantOption[0].locales;
            delete response.data.VariantOption[0].locales;
            return response;
        });
    };

    this.save = function(apiPath, object) {
        var formToken = object.FORM_SECURITY_TOKEN;
        delete object.FORM_SECURITY_TOKEN;
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

        return crudSrv.save(requestPath, object, objectType, formToken);
    };
});
