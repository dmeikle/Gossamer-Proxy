(function() {
    'use strict';

    angular
        .module('claimsAdmin')
        .controller('ClaimsLocationsAreaModalCtrl', ClaimsLocationsAreaModalCtrl);

    function ClaimsLocationsAreaModalCtrl($uibModalInstance, $log, crudSrv, location, item) {
        
        var vm = this;
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        vm.item = item;
        
        vm.close = function () {
            $uibModalInstance.dismiss();
        };
        
        vm.save = function () {
            vm.item.ClaimsLocations_id = location.id;
            var apiPath = '/admin/scoping/affected-areas/' + vm.item.id;
            vm.saving = true;
            crudSrv.save(apiPath, vm.item, 'AffectedArea', formToken).then(function(response){
                vm.saving = false;
                $log.log(response);
                $uibModalInstance.close();                
            });
        };
        
        vm.getAreaDetails = function() {
            if(!vm.item.id){
                vm.item.id = 0;
            }
        };

        activate();
        
        function activate() {
            vm.getAreaDetails();
        }

    }
})();