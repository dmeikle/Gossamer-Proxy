module.controller('staffPhotoCtrl', function ($rootScope, $scope, staffPhotoSrv) {
    var staffId = document.getElementById('Staff_id').value;
    
    var self = this;
    
    self.displayForm = false;
    
    $rootScope.$on('DISPLAY_PHOTO_UPLOAD_FORM', function() {
       self.displayForm = true; 
    });
    
    self.dropzoneConfig = {
        'options': {// passed into the Dropzone constructor
            'url': '/admin/staff/photo/upload/' + staffId,
            'uploadMultiple': false,
            'dictDefaultMessage': ''
        },
        'eventHandlers': {
            'sending': function (file, xhr, formData) {
            },
            'success': function (file, response) {
                getStaffPhoto();
            }
        }
    };

    getStaffPhoto = function () {
        staffPhotoSrv.getStaffPhoto(staffId);
    };
    
    
});
