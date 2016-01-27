(function() {
//    'use strict';

    angular
        .module('claimsAdmin')
        .controller('claimsLocationsCtrl', claimsLocationsCtrl);

    function claimsLocationsCtrl($timeout, notesSrv, claimsTemplateSrv, $uibModal, crudSrv, $log) {
        var vm = this;
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        
        vm.claim = {};
        vm.documentsConfig = {};        
        vm.claimLocationDocumentModal = claimsTemplateSrv.claimLocationDocumentModal;     
        vm.selectedEquipment = [];
        vm.editingInstructions = false;
        
        vm.openAffectedAreasModal = function (template, area) {
            var modalInstance = $uibModal.open({
              templateUrl: template,
              controller: 'ClaimsLocationsAreaModalCtrl',
              controllerAs: 'modal',
              size: 'md',
              resolve: {
                location: function () {
                  return vm.location;
                },
                item: function () {
                    return area;
                }
              }
            });
            modalInstance.result.then(function () {
                getAffectedAreas();
            }, function () {
                //modal dismissed              
            });
        };
        
        vm.openCustomersModal = function (template, customer) {
            var modalInstance = $uibModal.open({
              templateUrl: template,
              controller: 'ClaimsLocationsCustomerModalCtrl',
              controllerAs: 'modal',
              size: 'md',
              resolve: {
                location: function () {
                  return vm.location;
                },
                customer: function () {
                    return customer;
                }
              }
            });

            modalInstance.result.then(function (customer) {
                //getAffectedAreas();
                updateCustomers(customer);
            }, function () {
                //modal dismissed                
            });
        };
        
        vm.openEquipmentTransferModal = function (template) {
            var modalInstance = $uibModal.open({
              templateUrl: template,
              controller: 'transferModalController',
              controllerAs: 'modal',
              size: 'md',
              resolve: {
                multiSelectArray: function () {
                  return vm.selectedEquipment;
                },
                location: function () {
                    return vm.location;
                }
              }
            });

            modalInstance.result.then(function (customer) {
                //getAffectedAreas();
//                updateCustomers(customer);
            }, function () {
                //modal dismissed                
            });
        };
        
        vm.checkSelectedEquipment = function() {
            vm.selectedEquipment = [];
            for(var i in vm.equipmentLocations) {
                if(vm.equipmentLocations[i].isSelected === true) {
                    vm.selectedEquipment.push(vm.equipmentLocations[i]);
                } else {
                    vm.selectAllEquipment = false;
                }
            }
        };
        
        vm.selectAllEquipmentToggle = function(value) {
            for(var i in vm.equipmentLocations) {
                if(value === true){
                    vm.equipmentLocations[i].isSelected = true;
                } else {
                    vm.equipmentLocations[i].isSelected = false;
                }
            }
            vm.checkSelectedEquipment();
        };
        
        vm.editInstructions = function() {
            vm.editingInstructions = !vm.editingInstructions;
            
            //Create a backup if they decide to cancel their current action
            if(vm.editingInstructions === true){
                vm.instructionsBackup = vm.location.instructions;                
            } else {
                vm.location.instructions = vm.instructionsBackup;     
            }
        };
        
//        function getSelectedEquipment() {
//            var selectedEquipment = [];
//            for(var i in vm.equipmentLocations){
//                if(vm.equipmentLocations[i].isSelected === true) {
//                    selectedEquipment.push(vm.equipmentLocations[i]);
//                }
//            }
//            return selectedEquipment;
//        }
        
        
//        vm.saveLocation = function () {
//            var apiPath = '/admin/claims/locations/' + vm.location.id;
//            crudSrv.save(apiPath, vm.location, 'ClaimLocation', formToken);
//        };
        
        vm.saveInstructions = function () {
            var apiPath = '/admin/claims/locations/' + vm.location.id;
            vm.editingInstructions = false;
            vm.savingInstructions = true;
            crudSrv.save(apiPath, vm.location, 'ClaimLocation', formToken).then(function(){
                vm.savingInstructions = false;
            });
        };
        
        vm.removeCustomer = function (customer) {
            var apiPath = '/admin/customers/remove/' + customer.id;
            crudSrv.save(apiPath, vm.location, 'ClaimLocation', formToken);
        };
        
        activate();

        function activate() {
            vm.loaded = false;
            getLocationDetails();
        }
        
        //Get all the location details from the hidden input fields
        function getLocationDetails() {
            
            //This $timeout simply tells the function call on the next digest cycle
            //Done because element doesn't exist during the current $digest cycle due to ng-if in the view            
            $timeout(function(){
                vm.location = JSON.parse(document.getElementById('ClaimsLocation').value);
                vm.affectedAreas = JSON.parse(document.getElementById('AffectedAreas').value);
                vm.projectAddress = JSON.parse(document.getElementById('ProjectAddress').value);
                vm.phase = JSON.parse(document.getElementById('Phase').value);
                vm.claimsCustomers = JSON.parse(document.getElementById('ClaimsCustomers').value);
                vm.claimsLocationsNotes = JSON.parse(document.getElementById('ClaimsLocationsNotes').value);
                vm.equipmentLocations = JSON.parse(document.getElementById('EquipmentLocations').value);
                
                vm.claim.id = vm.location.Claims_id;
                vm.loaded = true;                
                vm.documentsConfig.Claims_id = vm.claim.id;
                vm.documentsConfig.ClaimsLocations_id = vm.location.id;
                
                formatCustomers(vm.claimsCustomers);
                formatNotes(vm.claimsLocationsNotes);
            });
        }
        
        function formatCustomers(customers) {
            vm.primaryCustomers = [];
            vm.secondaryCustomers = [];
            
            for(var i in customers) {
                if(customers[i].isPrimary === "1") {
                    vm.primaryCustomers.push(customers[i]);
                } else if( customers[i].isPrimary === "0") {
                    vm.secondaryCustomers.push(customers[i]);
                }                
            }
        }
        
        //Format the notes (if needed)
        function formatNotes(notes) {
            if(notes.length > 0 && notes[0].length === undefined) {
                notesSrv.notes = notesSrv.getNotes(notes);
            }
        }
        
        function getAffectedAreas () {
            vm.affectedAreasLoading = true;
            var apiPath = '/admin/scoping/affected-areas/get/';
            crudSrv.getDetails(apiPath, vm.location.id).then(function(response){
                vm.affectedAreas = response.data.AffectedAreas;
                vm.affectedAreasLoading = false;
            });
        }
        
        
        //Update the customers list when the modal is closed
        function updateCustomers (customer) {
            for(var i in vm.claimsCustomers) {
                if(vm.claimsCustomers[i].id === customer.id) {
                    vm.claimsCustomers[i] = customer;
                } else {
                    if(parseInt(i) === vm.claimsCustomers.length-1) {
                        vm.claimsCustomers.push(customer);
                    }
                }
            }
            formatCustomers(vm.claimsCustomers);            
        }
    }
})();