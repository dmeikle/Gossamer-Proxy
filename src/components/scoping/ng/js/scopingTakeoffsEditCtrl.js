(function () {
//    'use strict';
    
    angular
            .module('scopingAdmin')
            .controller('scopingTakeoffsEditCtrl', scopingTakeoffsEditCtrl);
    
    function scopingTakeoffsEditCtrl(scopingTakeOffsEditSrv, tableControlsSrv, $log) {
        var vm = this;
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        
        vm.test = ' hello this is a test!';
        vm.takeOff = getTakeoffDetails(vm.claimId);
        vm.loading = true;
        
        vm.insulationVariants = [{
            option: '16x14',
            VariantOptions_id: '17'
        },{
            option: '16x22',
            VariantOptions_id: '18'
        },{
            option: '24x14',
            VariantOptions_id: '19'
        },{
            option: '24x22',
            VariantOptions_id: '20'
        }];
        
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
        
        vm.save = function () {
            $log.log('log!');
            scopingTakeOffsEditSrv.save(vm.lineItems, formToken);
        };
        
        activate();
        
        function activate() {
            vm.lineItems = [new LineItem()];
        }
        
        
    }
})();