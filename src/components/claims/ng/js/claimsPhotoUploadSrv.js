module.service('photoUploadSrv', function(crudSrv, $rootScope) {
	var self = this;
	var apiPath = '/admin/claim/photos/count/';
	
	this.generateDropzoneConfig = function(claimId, claimLocationId) {
		this.claimId = claimId;
        return {
            'options': {
                'url': '/admin/claims/locations/photos/upload/' + 
                    claimId + '/' + claimLocationId,
                'uploadMultiple': true,
                'dictDefaultMessage': '',
                // 'previewTemplate': '
            },
            'eventHandlers': {
                'success': function(file, response) {
		            $rootScope.$broadcast('photoUploaded', response);
		        }
            }
        };
    };

    this.getPhotoCount = function(claimId) {
    	return crudSrv.getDetails(apiPath, claimId).then(function(response) {
    		$rootScope.$broadcast('photoCountUpdated', response);
    		return response;
    	});
    };
});