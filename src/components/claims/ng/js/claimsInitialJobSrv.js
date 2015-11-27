module.service('claimsInitialJobsheetSrv', function($http) {
    var apiPathSave = '/admin/claim/initial-jobsheet/save/';
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