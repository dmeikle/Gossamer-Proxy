(function() {
    'use strict';

    angular
        .module('claimsAdmin')
        .controller('ClaimsLocationsCustomerModalCtrl', ClaimsLocationsCustomerModalCtrl);

    function ClaimsLocationsCustomerModalCtrl($uibModalInstance, $scope, $log, crudSrv, location, customer, contactListSrv, searchSrv) {
        var vm = this;
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        $log.log(location);
        vm.customer = customer;
        vm.createNew = false;
        vm.saving = false;
        
        vm.close = function () {
            $uibModalInstance.dismiss();
        };
        
        vm.saveNewCustomer = function () {
            vm.newCustomer.Claims_id = location.Claims_id;
            vm.newCustomer.ClaimsLocations_id = location.id;
            vm.saving = true;
            var apiPath = '/admin/customers/0';
            crudSrv.save(apiPath, vm.newCustomer, 'Customer', formToken).then(function(response){
                vm.saving = false;
                var customer = response.data.Customer;
                $uibModalInstance.close(customer);
            });
        };
        
        vm.saveExistingCustomer = function () {
            vm.customer.Claims_id = location.Claims_id;
            vm.customer.ClaimsLocations_id = location.id;
            vm.saving = true;
            var apiPath = '/admin/customers/' + vm.customer.id;
            crudSrv.save(apiPath, vm.customer, 'Customer', formToken).then(function(response){
                vm.saving = false;
                var customer = response.data.Customer;
                $uibModalInstance.close(customer);
            });
        };
        
        vm.getContactDetails = function() {
            if(!vm.customer.id){
                vm.customer.id = 0;
            }
        };

        activate();
        
        vm.customersAutocomplete = function(value, type) {
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