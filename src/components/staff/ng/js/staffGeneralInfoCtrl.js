(function () {
    
    angular
            .module('staffAdmin')
            .controller('staffGeneralInfoCtrl', staffGeneralInfoCtrl);
    
    function staffGeneralInfoCtrl(staffSrv, $rootScope, $log, $scope) {
        var self = this;
        
        $rootScope.$on('STAFF_LOADED', function(event, args) {
            self.staff = args.staff;
        });
        
        $rootScope.$on('PROFILE_PIC_UPDATED', function(event, fileName) {
//            self.displayForm = true;
            $log.log('loaded the file! ' + fileName);
            self.staff.imageName = fileName;
            $log.log(self.staff);
            $scope.$digest();
        });
        
        self.displayPhotoUploadForm = function() {
           $rootScope.$broadcast('DISPLAY_PHOTO_UPLOAD_FORM');
        };
        
    }
})();