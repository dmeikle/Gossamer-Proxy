(function() {
    'use strict';

    angular
        .module('claimsAdmin')
        .controller('ClaimsLocationsModalCtrl', ClaimsLocationsModalCtrl);

    function ClaimsLocationsModalCtrl($uibModalInstance, $scope, $log, crudSrv, ClaimsLocations_id, item, contactListSrv) {
//        $log.log(ClaimsLocations_id);
        var vm = this;
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        vm.item = item;
        vm.item.ClaimsLocations_id = ClaimsLocations_id;
        vm.createNew = false;
        vm.test = 'why';
        
        vm.close = function () {
            $uibModalInstance.dismiss();
        };
        
        vm.save = function () {
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
        
        vm.contactsAutocomplete = function(value, type) {
            return contactListSrv.autocomplete(value, type);
        };
        
        vm.getContact = function(contact) {
            vm.item = contact;
            vm.contact = '';
        };

        function activate() {
            vm.getAreaDetails();
        }

    }
})();