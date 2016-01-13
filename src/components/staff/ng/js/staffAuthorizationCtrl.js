

(function () {
    
    angular
            .module('staffAdmin')
            .controller('staffAuthorizationCtrl', staffAuthorizationCtrl);
    
    function staffAuthorizationCtrl($rootScope, staffSrv) {
        var self = this;
        
        $rootScope.$on('STAFF_LOADED', function(event, args) {
            if(args.staff.id !== undefined && args.staff.id > 0) {
                self.staffLoaded = true;
                loadAuthorizations(args.staff);                
            }
        });
        
        $rootScope.$on('STAFFAUTHORIZATION_LOADED', function(event, args) {
            self.staffAuthorization = args.staffAuthorization;
            delete self.staffAuthorization.username;
        });
        
        
        function loadAuthorizations(staff) {           
            staffSrv.getAuthorization(staff.id).then(function(staffAuthorization) {
		$rootScope.$broadcast('STAFFAUTHORIZATION_LOADED', {staffAuthorization: staffAuthorization});                
            });
        }
        
    }
})();