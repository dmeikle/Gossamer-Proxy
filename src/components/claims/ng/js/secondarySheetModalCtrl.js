(function() {
    'use strict';

    angular
        .module('claimsAdmin')
        .controller('secondarySheetsModalCtrl', secondarySheetsModalCtrl);

    function secondarySheetsModalCtrl($uibModalInstance, secondarySheetResults, claimsSecondarySheetsSrv, $log) {
        /* jshint validthis: true */
        var vm = this;
        
        vm.secondarySheetResults = secondarySheetResults;
    
        vm.ok = function () {
            $uibModalInstance.close($scope.selected.item);
        };

        vm.cancel = function () {
            $uibModalInstance.dismiss();
        };
        
        vm.itemChanged = function(object) {
            var index = object.isDone < 0 ? (-1 * object.isDone) : object.isDone;
      
            vm.secondarySheetResults.item[index] = object.isDone < 0 ? 0 : 1;
        };
        
        vm.saveSecondarySheet = function(secondarySheet) {
            
            secondarySheet.Claims_id = document.getElementById('Claims_id').value;
            secondarySheet.ClaimsLocations_id = document.getElementById('ClaimsLocations_id').value;
            secondarySheet.AffectedAreas_id = document.getElementById('AffectedAreas_id').value;
            secondarySheet.SecondarySheets_id = document.getElementById('SecondarySheets_id').value;
            
            var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
            
            claimsSecondarySheetsSrv.saveResponses(secondarySheet, formToken);
        };
        
        vm.saveSecondarySheetResults = function(items) {
            var secondarySheet = {};
            var results = [];
            for(var index in items.item) {
                var item = {};
                item.AffectedAreaActions_id = index;
                item.isDone = items.item[index];
                results.push(item);
            }
            secondarySheet.item = results; //items.item;
            vm.saveSecondarySheet(secondarySheet);
        };
        //this is for trimming the result set down
        self.formatResults = function(items) {
            var retval = [];
            for(var index in items) {
                if(items[index].isDone !== undefined && '1' == items[index].isDone) {
                    retval.push(items[index]);
                }
            }
            
            return retval;
        };
    }
})();

