module.controller('staffPhotoCtrl', function ($rootScope, $scope, staffPhotoSrv, $log) {
    var staffId = document.getElementById('Staff_id').value;
    
    var self = this;
    
    self.displayForm = false;
    self.uploading = false;
    
//    $rootScope.$on('DISPLAY_PHOTO_UPLOAD_FORM', function() {
//       self.displayForm = true; 
//    });
    
    $scope.dropzoneConfig = {
        'options': {// passed into the Dropzone constructor
            'url': '/admin/staff/photo/upload/' + staffId,
            'uploadMultiple': false,
            'dictDefaultMessage': ''
        },
        'eventHandlers': {
            'sending': function (file, xhr, formData) {
                self.uploading = true;
                $scope.$digest();
            },
            'success': function (file, response) {
                self.uploading = false;
                $rootScope.$broadcast('PROFILE_PIC_UPDATED', response.fileName);
            }
        }
    };

    getStaffPhoto = function () {
        staffPhotoSrv.getStaffPhoto(staffId);
    };
    
    
});
