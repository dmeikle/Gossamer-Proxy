//module.controller('scopingTakeoffsEditCtrl', function($scope, scopingTakeOffsEditSrv) {
//	$scope.loading = true;
//
//	
//	$scope.takeOff = getTakeoffDetails($scope.claimId);
//	
//
//	function getTakeoffDetails() {
//            var claimId = document.getElementById('Claims_id').value;
//            var claimsLocationsId = document.getElementById('ClaimsLocations_id').value;
//            scopingTakeOffsEditSrv.getTakeoffDetails(claimId, claimsLocationsId).then(function () {
//                $scope.takeoff = scopingTakeOffsEditSrv.takeOffDetails;
//                $scope.loading = false;
//            });
//	}
//});

(function () {
//    'use strict';
    
    angular
            .module('scopingAdmin')
            .controller('scopingTakeoffsEditCtrl', scopingTakeoffsEditCtrl);
    
    function scopingTakeoffsEditCtrl(scopingTakeOffsEditSrv, tableControlsSrv, $log) {
        var vm = this;
        
        vm.test = ' hello this is a test!';
        vm.takeOff = getTakeoffDetails(vm.claimId);
        vm.loading = true;
        vm.lineItems = [new LineItem()];
        
        function LineItem () {
            this.isSelected = false;
        }
        
        function getTakeoffDetails() {
            var claimId = document.getElementById('Claims_id').value;
            var claimsLocationsId = document.getElementById('ClaimsLocations_id').value;
            scopingTakeOffsEditSrv.getTakeoffDetails(claimId, claimsLocationsId).then(function () {
                vm.takeoff = scopingTakeOffsEditSrv.takeOffDetails;
                vm.loading = false;
            });
	}
        
        //Table Controls        
        //Add a new line item to the table
        vm.addRow = function(){   
            vm.lineItems = tableControlsSrv.addRow(vm.lineItems, new LineItem());
            vm.checkSelectAll();
        };

        //Inserts new line items under selected rows
        vm.insertRows = function () {
            vm.lineItems = tableControlsSrv.insertRows(vm.lineItems, new LineItem());
            vm.checkSelectAll();
        };

        //Removes and selected rows from the table
        vm.removeRows = function () {
            vm.lineItems = tableControlsSrv.removeRows(vm.lineItems);
            vm.checkSelectAll();
        };
        
        //Select all toggle for table
        vm.selectAllToggle = function (value) {
            vm.lineItems = tableControlsSrv.selectAll(vm.lineItems, value);
        };
        
        //check to see if a row is selected
        vm.checkSelected = function () {
            vm.rowSelected = tableControlsSrv.checkSelected(vm.lineItems);
            vm.checkSelectAll();
        };
        
        //check to see if a row is selected
        vm.checkSelectAll = function () {
            vm.selectAll = tableControlsSrv.checkSelectAll(vm.lineItems);
        };
        
        activate();
        
        function activate() {
//            $log.log('controller!');
        }
        
        
    }
})();