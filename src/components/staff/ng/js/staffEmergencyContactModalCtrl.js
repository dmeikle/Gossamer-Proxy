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
        .controller('staffEmergencyContactModalCtrl', staffEmergencyContactModalCtrl);

    function staffEmergencyContactModalCtrl($uibModalInstance, contact, staffEmergencyContactsSrv) {
        var self = this;
        

        self.save = function (item) {

            var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
            
            item.Staff_id = document.getElementById('Staff_id').value;
            
            staffEmergencyContactsSrv.save(item, formToken).then(function (response) {
                if (!response.data.result || response.data.result !== 'error') {
                    $uibModalInstance.close();
                }
            });
        };

        self.close = function () {
            $uibModalInstance.dismiss('close');
        };
    }
})();