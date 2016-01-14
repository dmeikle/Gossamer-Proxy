(function() {
    'use strict';

    angular
        .module('claimsAdmin')
        .controller('secondarySheetsModalCtrl', secondarySheetsModalCtrl);

    function secondarySheetsModalCtrl($uibModalInstance, secondarySheetResults, claimsSecondarySheetsSrv, $log) {
        /* jshint validthis: true */
        var vm = this;
        
        vm.secondarySheetResults = secondarySheetResults;
        $log.log(secondarySheetResults);
        vm.ok = function () {
            $uibModalInstance.close($scope.selected.item);
        };

        vm.cancel = function () {
            $uibModalInstance.dismiss();
        };
        
        vm.saveSecondarySheet = function(secondarySheet) {
            
            secondarySheet.Claims_id = document.getElementById('Claims_id').value;
            secondarySheet.ClaimsLocations_id = document.getElementById('ClaimsLocations_id').value;
            secondarySheet.AffectedAreas_id = document.getElementById('AffectedAreas_id').value;
            secondarySheet.SecondarySheets_id = document.getElementById('SecondarySheets_id').value;
            
            var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
            
            claimsSecondarySheetsSrv.save(secondarySheet, formToken);
        };
        
        vm.saveSecondarySheetResults = function(items) {
            var secondarySheet = {};
            secondarySheet.item = items.item;
            vm.saveSecondarySheet(secondarySheet);
        };
        
        activate();

        function activate() {

        }
    }
})();

