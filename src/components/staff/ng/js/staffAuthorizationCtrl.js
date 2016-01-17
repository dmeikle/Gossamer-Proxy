

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
            delete self.staffAuthorization.roles;
        });
        
        
        function loadAuthorizations(staff) {           
            staffSrv.getAuthorization(staff.id).then(function(staffAuthorization) {
		$rootScope.$broadcast('STAFFAUTHORIZATION_LOADED', {staffAuthorization: staffAuthorization});                
            });
        }
        
        
        self.submitCredentials = function(credentials) {
            var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
            credentials.Staff_id = document.getElementById('Staff_id').value;
            
            switch (credentials.emailUser) {
                case true:
                    staffSrv.generateEmailReset(credentials, formToken);
                    break;
                default:
                    staffSrv.saveCredentials(credentials, formToken).then(function (response) {
                        if(response.StaffAuthorization == undefined) {
                            self.credentialStatus = response;
                        }                        
                    });
            }
        };
    }
})();