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
        .module('scopingAdmin')
        .controller('scopingWriterModalCtrl', scopingWriterModalCtrl);

    function scopingWriterModalCtrl($uibModalInstance, $scope, scopingSrv, claim) {
       
        $scope.staffList = [];
       
        $scope.dateOptions = {'starting-day': 1};


        $scope.openDatepicker = function (datepicker) {            
            self.isOpen[datepicker] = true;
        };

        $scope.selectScopeWriter = function(Staff_id) {
            var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
            var scopingInstance = {};
            scopingInstance.Staff_id = Staff_id;
            scopingInstance.Claims_id = claim.id;
            scopingInstance.ScopingInstanceStatuses_id = 2;
            
            scopingSrv.saveScopeWriter(scopingInstance, formToken).then(function(response) {               
                $scope.confirm();
            });
        };


        $scope.confirm = function() {
            $uibModalInstance.close();
        };

        $scope.cancel = function() {
            $uibModalInstance.dismiss('cancel');
        };
    }
})();


