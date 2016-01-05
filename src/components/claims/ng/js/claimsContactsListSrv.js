module.service('contactListSrv', function(searchSrv, crudSrv) {
	this.autocomplete = function(value, type) {
            var config = {};
            config[type] = value;

            return searchSrv.autocomplete('/admin/contacts/', config).then(function(response){
                //console.log(response);
                if(response.data.ContactsCount[0].rowCount > 0) { 
                    return response.data.Contacts;
                } else {
                    return undefined;
                }
        	
            });
	};

	this.save = function(object, formToken, claimId) {
            object.Claims_id = claimId;
            delete object.id;
            return crudSrv.save('/admin/claim/contacts/' + claimId, object, 'ClaimContact', formToken);
	};
});