(function() {
//    'use strict';

    angular
        .module('claimsAdmin')
        .controller('claimsLocationsCtrl', claimsLocationsCtrl);

    function claimsLocationsCtrl($log, $timeout, $scope, $rootScope) {
        var vm = this;        
        vm.claim = {};
        vm.documentsConfig = {};
        // listen for the event in the relevant $scope
//        $scope.$on('event_thingy', function (event) {
//            console.log('event happened'); // 'Data to send'
//        });        
        
        activate();

        function activate() {
            vm.loaded = false;
            getLocationDetails();
        }
        
        
        function getLocationDetails() {
            
            //This $timeout simply tells the function call on the next digest cycle
            //Done because element doesn't exist during the current $digest cycle due to ng-if in the view            
            $timeout(function(){
                vm.location = JSON.parse(document.getElementById('ClaimsLocation').value);
                vm.affectedAreas = JSON.parse(document.getElementById('AffectedAreas').value);
                vm.projectAddress = JSON.parse(document.getElementById('ProjectAddress').value);
                vm.phase = JSON.parse(document.getElementById('Phase').value);
                vm.claimsCustomers = JSON.parse(document.getElementById('ClaimsCustomers').value);
                vm.claim.id = vm.location.Claims_id;
                vm.loaded = true;
                
                vm.documentsConfig.Claims_id = vm.claim.id;
                vm.documentsConfig.ClaimsLocations_id = vm.location.id;
//                $log.log(vm.claimsCustomers);
            });
            
            
        }
    }
})();