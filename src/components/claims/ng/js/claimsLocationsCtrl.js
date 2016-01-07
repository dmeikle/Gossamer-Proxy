(function() {
//    'use strict';

    angular
        .module('claimsAdmin')
        .controller('claimsLocationsCtrl', claimsLocationsCtrl);

    function claimsLocationsCtrl($log, $timeout, $scope, $rootScope) {
        var vm = this;        
        
        // listen for the event in the relevant $scope
//        $scope.$on('event_thingy', function (event) {
//            console.log('event happened'); // 'Data to send'
//        });        
        
        activate();

        function activate() {
            vm.loaded = true;
            getLocationDetails();
        }
        
        
        function getLocationDetails() {
            
            //This $timeout simply tells the function call on the next digest cycle
            //Done because element doesn't exist during the current $digest cycle due to ng-if in the view            
            $timeout(function(){
                vm.location = JSON.parse(document.getElementById('ClaimsLocation').value);
                vm.affectedAreas = JSON.parse(document.getElementById('AffectedAreas').value);
                vm.projectAddress = JSON.parse(document.getElementById('ProjectAddress').value);
//                $log.log(vm.location);
            });
            
            
        }
    }
})();