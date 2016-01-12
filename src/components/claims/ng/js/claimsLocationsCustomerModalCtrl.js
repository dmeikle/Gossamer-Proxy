(function() {
    'use strict';

    angular
        .module('claimsAdmin')
        .controller('ClaimsLocationsCustomerModalCtrl', ClaimsLocationsCustomerModalCtrl);

    function ClaimsLocationsCustomerModalCtrl($uibModalInstance, $scope, $log, crudSrv, location, customer, contactListSrv, searchSrv) {
        var vm = this;
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        vm.customer = customer;
        vm.createNew = false;
        
        vm.close = function () {
            $uibModalInstance.dismiss();
        };
        
//        vm.save = function () {
//            vm.item.id = location.id;
//            var apiPath = '/admin/scoping/affected-areas/' + vm.item.id;
//            crudSrv.save(apiPath, vm.item, 'AffectedArea', formToken);
//            $uibModalInstance.close();
//        };
        
        vm.saveNewCustomer = function () {
            var apiPath = '/admin/scoping/affected-areas/' + vm.customer.id;
            crudSrv.save(apiPath, vm.customer, 'AffectedArea', formToken);
        };
        
        vm.getContactDetails = function() {
            if(!vm.customer.id){
                vm.customer.id = 0;
            }
        };

        activate();
        
        vm.customerAutocomplete = function(value, type) {
//            return contactListSrv.autocomplete(value, type);
            var config = {};
            config[type] = value;
            return searchSrv.autocomplete('/admin/customers/', config).then(function(response){
                return response.data.Customers;
            });
        };
        
        vm.getCustomer = function(customer) {
            vm.customer = customer;
            vm.customerInput = '';
        };

        function activate() {
            
        }

    }
})();