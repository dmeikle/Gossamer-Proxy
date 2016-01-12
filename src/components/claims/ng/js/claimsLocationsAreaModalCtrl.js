(function() {
    'use strict';

    angular
        .module('claimsAdmin')
        .controller('ClaimsLocationsAreaModalCtrl', ClaimsLocationsAreaModalCtrl);

    function ClaimsLocationsAreaModalCtrl($uibModalInstance, $log, crudSrv, location, item) {
//        $log.log(ClaimsLocations_id);
        var vm = this;
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        vm.item = item;
//        vm.item.ClaimsLocations_id = location.ClaimsLocations_id;
        
        vm.close = function () {
            $uibModalInstance.dismiss();
        };
        
        vm.save = function () {
//            vm.item.id = location.id;
            vm.item.ClaimsLocations_id = location.id;
            $log.log(vm.item);
            var apiPath = '/admin/scoping/affected-areas/' + vm.item.id;
            crudSrv.save(apiPath, vm.item, 'AffectedArea', formToken);
            $uibModalInstance.close();
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