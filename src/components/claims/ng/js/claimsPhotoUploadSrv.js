module.service('photoUploadSrv', function() {
	
	this.generateDropzoneConfig = function(claimId, claimLocationId) {
        return {
            'options': {
                'url': '/admin/claimlocations/photos/upload/' + 
                    claimId + '/' + claimLocationId,
                'uploadMultiple': true,
                'dictDefaultMessage': ''
            },
            'eventHandlers': {
                'success': function() {
		            photoUploadSrv.getPhotoCount(claimLocationId);
		        }
            }
        };
    };

    this.getPhotoCount = function(claimLocationId) {
    	return ;
    };
});