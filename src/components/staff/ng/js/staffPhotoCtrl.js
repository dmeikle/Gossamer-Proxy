module.controller('staffPhotoCtrl', function ($scope, $location, staffPhotoSrv) {
    var staffId = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);
    $scope.dropzoneConfig = {
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
