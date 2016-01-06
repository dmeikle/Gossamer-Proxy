module.service('claimsLocationsEditSrv', function(crudSrv) {
	var objectType = 'ClaimLocation';
	var apiPath = '/admin/claims/locations/claim/';

	this.save = function(object) {
		for (var property in object) {
            if (object.hasOwnProperty(property) && 
                property.substr(property.length - 3) == '_id' && 
                !object[property]) {
                delete object[property];
            }
        }
        delete object.$$hashKey;
		var requestPath;
		if (!object.id || object.id === '') {
            requestPath = apiPath + '0';
        } else {
            requestPath = apiPath + object.id;
        }
		var formToken = object.FORM_SECURITY_TOKEN;
		return crudSrv.save(requestPath, object, objectType, formToken);
	};

	this.delete = function(object) {
		for (var property in object) {
            if (object.hasOwnProperty(property) && 
                property.substr(property.length - 3) == '_id' && 
                !object[property]) {
                delete object[property];
            }
        }

		var formToken = object.FORM_SECURITY_TOKEN;
		return crudSrv.save('/admin/claims/locations/remove/' + object.id, object, objectType, formToken);
	};
});