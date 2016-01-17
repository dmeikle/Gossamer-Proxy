(function () {
    
    angular
            .module('staffAdmin')
            .controller('staffGeneralInfoCtrl', staffGeneralInfoCtrl);
    
    function staffGeneralInfoCtrl(staffSrv, $rootScope) {
        var self = this;
        
        $rootScope.$on('STAFF_LOADED', function(event, args) {
            self.staff = args.staff;
        });
        
        self.displayPhotoUploadForm = function() {
           $rootScope.$broadcast('DISPLAY_PHOTO_UPLOAD_FORM');
        };
        
    }
})();