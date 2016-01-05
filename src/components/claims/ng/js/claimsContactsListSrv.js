module.service('contactListSrv', function(searchSrv, crudSrv) {
	this.autocomplete = function(value, type) {
            var config = {};
            config[type] = value;

            return searchSrv.autocomplete('/admin/contacts/', config).then(function(response){
                console.log(response);
        	return response.data.Contacts;
            });
	};

	this.save = function(object, formToken, claimId) {
            object.Claims_id = claimId;
            delete object.id;
            return crudSrv.save('/admin/claim/contacts/' + claimId, object, 'ClaimContact', formToken);
	};
});