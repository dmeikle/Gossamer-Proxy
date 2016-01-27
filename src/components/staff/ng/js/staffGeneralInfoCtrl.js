(function () {
    
    angular
            .module('staffAdmin')
            .controller('staffGeneralInfoCtrl', staffGeneralInfoCtrl);
    
    function staffGeneralInfoCtrl(staffSrv, $rootScope, $log, $scope) {
        var self = this;
        self.displayForm = false;
        
        $rootScope.$on('STAFF_LOADED', function(event, args) {
            self.staff = args.staff;
        });
        
        $rootScope.$on('PROFILE_PIC_UPDATED', function(event, fileName) {
            self.staff.imageName = fileName;
            self.displayForm = false;
            $scope.$digest();
            
        });
        
        self.displayPhotoUploadForm = function() {
//           $rootScope.$broadcast('DISPLAY_PHOTO_UPLOAD_FORM');
            if(self.displayForm === false) {
               self.displayForm = true;                
            } else {
                self.displayForm = false; 
            }
        };
        
    }
})();