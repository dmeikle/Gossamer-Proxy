(function() {
//    'use strict';

    angular
        .module('claimsAdmin')
        .controller('claimsLocationsCtrl', claimsLocationsCtrl);

    function claimsLocationsCtrl($log, $timeout, notesSrv, claimsTemplateSrv, $uibModal, crudSrv) {
        var vm = this;        
        vm.claim = {};
        vm.documentsConfig = {};        
        
        vm.claimLocationDocumentModal = claimsTemplateSrv.claimLocationDocumentModal;
        
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
                $log.log('modal dismissed');                
            });
        };
        
        vm.openContactsModal = function (template, customer) {
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

            modalInstance.result.then(function () {
                getAffectedAreas();
            }, function () {
                $log.log('modal dismissed');                
            });
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
//                $log.log(vm.claimsCustomers);

                formatNotes(vm.claimsLocationsNotes);
            });            
            
        }       
        
        //Format the notes (if needed)
        function formatNotes(notes) {
//            $log.log(notes);            
            if(notes.length > 0) {
                notesSrv.notes = notesSrv.getNotes(notes);
            }
        }
        
        function getAffectedAreas () {
            vm.affectedAreasLoading = true;
            var apiPath = '/admin/scoping/affected-areas/get/';      
//            $log.log(vm.affectedAreas);
            
            crudSrv.getDetails(apiPath, vm.location.id).then(function(response){
               vm.affectedAreas = response.data.AffectedAreas;
//               $log.log(response);
                vm.affectedAreasLoading = false;
            });
        }
        
        
        
        
    }
})();