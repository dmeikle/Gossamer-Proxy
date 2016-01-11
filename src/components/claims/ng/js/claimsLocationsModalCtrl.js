(function() {
    'use strict';

    angular
        .module('claimsAdmin')
        .controller('ClaimsLocationsModalCtrl', ClaimsLocationsModalCtrl);

    function ClaimsLocationsModalCtrl($uibModalInstance, $scope, $log, crudSrv, ClaimsLocations_id) {
//        $log.log(ClaimsLocations_id);
        var vm = this;
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        vm.item = {};
        vm.item.ClaimsLocations_id = ClaimsLocations_id;
        
        vm.close = function () {
            $uibModalInstance.dismiss();
        };
        
        vm.save = function () {
            var apiPath = '/admin/scoping/affected-areas/0';
            crudSrv.save(apiPath, vm.item, 'AffectedArea', formToken);
            $uibModalInstance.close();
        };

        activate();

        function activate() {

        }

    }
})();