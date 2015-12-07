module.service('photoUploadSrv', function(crudSrv, $rootScope) {
	var self = this;
	var apiPath = '/admin/claimlocations/photos/count/';
	
	this.generateDropzoneConfig = function(claimId, claimLocationId) {
        return {
            'options': {
                'url': '/admin/claimlocations/photos/upload/' + 
                    claimId + '/' + claimLocationId,
                'uploadMultiple': true,
                'dictDefaultMessage': '',
                // 'previewTemplate': '
            },
            'eventHandlers': {
                'success': function() {
		            self.getPhotoCount(claimLocationId);
		        }
            }
        };
    };

    this.getPhotoCount = function(claimLocationId) {
    	return crudSrv.getDetails(apiPath, claimLocationId).then(function(response) {
    		$rootScope.$broadcast('photoCountUpdated', response);
    	});
    };
});