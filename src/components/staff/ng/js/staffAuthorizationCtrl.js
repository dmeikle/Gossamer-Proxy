

(function () {
    
    angular
            .module('staffAdmin')
            .controller('staffAuthorizationCtrl', staffAuthorizationCtrl);
    
    function staffAuthorizationCtrl($rootScope, $scope, staffSrv) {
        var self = this;
        
        $rootScope.$on('STAFF_LOADED', function(event, args) {
            if(args.staff.id !== undefined && args.staff.id > 0) {
                self.staffLoaded = true;
                loadAuthorizations(args.staff);                
            }
        });
        
        $scope.$on('STAFFAUTHORIZATION_LOADED', function(event, args) {
            self.staffAuthorization = args.staffAuthorization;
        });
        
        
        function loadAuthorizations(staff) {           
            staffSrv.getAuthorization(staff.id).then(function(staffAuthorization) {
		$scope.$broadcast('STAFFAUTHORIZATION_LOADED', {staffAuthorization: staffAuthorization});                
            });
        }
    }
})();