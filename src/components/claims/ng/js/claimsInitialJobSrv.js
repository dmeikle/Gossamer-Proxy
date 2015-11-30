module.service('claimsInitialJobsheetSrv', function($http, crudSrv) {
    var apiPathSave = '/admin/claim/initial-jobsheet/save/';
    var apiPath = '/admin/claim/initial-jobsheet/get/';

    this.save = function(object, formToken, ids) {
    	var apiPath = apiPathSave + ids;
    	object.FORM_SECURITY_TOKEN = formToken;
        return $http({
            method: 'POST',
            url: apiPath,
            data: object,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });
    };

    this.getJobsheetDetails = function(claimId, claimLocationId) {
    	var ids = claimId + '/' + claimLocationId;
    	return crudSrv.getDetails(apiPath, ids);
    };

    this.roomList = [
    		'',
        	'entry',
        	'closet',
        	'hallway',
        	'kitchen',
        	'livingroom',
        	'diningroom',
        	'bathroom1',
        	'bathroom2',
        	'masterBed',
        	'bedroom1',
        	'den',
        	'laundry',
        	'isOther'
        ];
});