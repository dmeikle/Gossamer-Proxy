module.service('claimsLocationsEditSrv', function(crudSrv) {
	var objectType = 'ClaimLocation';
	var apiPath = '/admin/claimlocations/claim/';

	this.save = function(object) {
		var requestPath;
		if (!object.id || object.id === '') {
            requestPath = apiPath + '0';
        } else {
            requestPath = apiPath + object.id;
        }
		var formToken = object.FORM_SECURITY_TOKEN;
		return crudSrv.save(requestPath, object, objectType, formToken);
	};
});