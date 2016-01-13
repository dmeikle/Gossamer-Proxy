    /* 
     *  This file is part of the Quantum Unit Solutions development package.
     * 
     *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
     * 
     *  For the full copyright and license information, please view the LICENSE
     *  file that was distributed with this source code.
     */
    
    
(function() {
    
    angular
        .module('staffAdmin')
        .controller('staffCredentialsCtrl', staffCredentialsCtrl);

    function staffCredentialsCtrl($rootScope, staffSrv) {
        var self = this;
        self.staffLoaded = false;

       
        $rootScope.$on('STAFFAUTHORIZATION_LOADED', function(event, args) {
            self.staffLoaded = true;
            self.credentials = args.staffAuthorization;
            delete self.credentials.roles;
        });
        
        
        self.submitCredentials = function(credentials) {
            var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
            credentials.Staff_id = document.getElementById('Staff_id').value;
            
            switch (credentials.emailUser) {
                case true:
                    staffSrv.generateEmailReset(credentials, formToken);
                    break;
                default:
                    staffSrv.saveCredentials(credentials, formToken).then(function (response) {
                        $scope.credentialStatus = staffEditSrv.credentialStatus;
                    });
            }
        };
    }
})();