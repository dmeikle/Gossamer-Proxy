(function () {
//    'use strict';
    
    angular
            .module('scopingAdmin')
            .controller('scopingTakeoffsEditCtrl', scopingTakeoffsEditCtrl);
    
    function scopingTakeoffsEditCtrl($scope, scopingTakeOffsEditSrv, tableControlsSrv, $log, totalsSrv) {
        var vm = this;
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        var Claims_id = document.getElementById('Claims_id').value;
        var ClaimsLocations_id = document.getElementById('ClaimsLocations_id').value;
        var id = '';
        
        vm.test = ' hello this is a test!';
        vm.loading = true;
        
        //Set a deep watch on the line items so that we can calculate the column totals when they change.
        $scope.$watch('vm.lineItems', function(newValue, oldValue) {
            vm.getColumnTotals();
        }, true);
        
        //Insulation Variants (hard-coded for now...)
        vm.insulationVariants = [{
            variant: '16x14',
            VariantOptions_id: '17',
            InventoryItems_id: '35'
        },{
            variant: '16x22',
            VariantOptions_id: '18',
            InventoryItems_id: '35'
        },{
            variant: '24x14',
            VariantOptions_id: '19',
            InventoryItems_id: '35'
        },{
            variant: '24x22',
            VariantOptions_id: '20',
            InventoryItems_id: '35'
        }];
        
        //J Bead Variants (hard-coded for now...)
        vm.jBeadVariants = [{
            variant: '1/2"',
            VariantOptions_id: '21',
            InventoryItems_id: '19'
        },{
            variant: '3/4"',
            VariantOptions_id: '22',
            InventoryItems_id: '19'
        }];
        
        //Default line items, sets default values for certain line items.
        //Inventory Items ID will be hard-coded for now        
        function LineItem () {
//            this.isSelected = false;
            this.insulation = angular.copy(vm.insulationVariants[0]);
            this.vapourBarrier = {
                InventoryItems_id: '17'
            };
            this.drywall12 = {
                InventoryItems_id: '1'
            };
            this.drywall58 = {
                InventoryItems_id: '4'
            };
            this.cornerBead = {
                InventoryItems_id: '18'
            };
            this.jBead = angular.copy(vm.jBeadVariants[0]);
            this.baseboard = {
                InventoryItems_id: '20'
            };
            this.cove = {
                InventoryItems_id: '21'
            };
            this.casing = {
                InventoryItems_id: '22'
            };
            this.other = {};
        }
        
        //Get takeoff details
        function getTakeoffDetails() {
            scopingTakeOffsEditSrv.getTakeoffDetails(Claims_id, ClaimsLocations_id).then(function (response) {
                if(response.id){
                    id = response.id;
                    vm.lineItems = scopingTakeOffsEditSrv.mapTakeoffItems(id, response.AreaTypes, response.lineItems, new LineItem());
                    scopingTakeOffsEditSrv.setVariants(vm.lineItems, vm.insulationVariants, vm.jBeadVariants);
                } else {
                    id = 0;
                    vm.lineItems = scopingTakeOffsEditSrv.setNewLineItems(response.AreaTypes, new LineItem());
                }
                vm.loading = false;                
            });
	}
        
        //Table Controls        
        //Add a new line item to the table
//        vm.addRow = function(){   
//            vm.lineItems = tableControlsSrv.addRow(vm.lineItems, new LineItem());
//            vm.checkSelectAll();
//        };
//
//        //Inserts new line items under selected rows
//        vm.insertRows = function () {
//            vm.lineItems = tableControlsSrv.insertRows(vm.lineItems, new LineItem());
//            vm.checkSelectAll();
//        };
//
//        //Removes and selected rows from the table
//        vm.removeRows = function () {
//            vm.lineItems = tableControlsSrv.removeRows(vm.lineItems);            
//            vm.checkSelected();
//        };
        
        //Select all toggle for table
//        vm.selectAllToggle = function (value) {
//            vm.lineItems = tableControlsSrv.selectAll(vm.lineItems, value);
//            vm.checkSelected();
//        };
//        
//        //check to see if a row is selected
//        vm.checkSelected = function () {
//            vm.rowSelected = tableControlsSrv.checkSelected(vm.lineItems);
//            vm.checkSelectAll();
//        };
        
        //check to see if a row is selected
//        vm.checkSelectAll = function () {
//            vm.selectAll = tableControlsSrv.checkSelectAll(vm.lineItems);
//        };
        
        //Set a item's variant and VariantOptions_id
        vm.setItemVariant = function (item, option) {
            item.variant = option.variant;
            item.VariantOptions_id = option.VariantOptions_id;
        };        
        
        //Save the takeoff sheet
        vm.save = function () {
            scopingTakeOffsEditSrv.save(id, vm.lineItems, Claims_id, ClaimsLocations_id, formToken);
        };
        
        //Get the column totals
        vm.getColumnTotals = function () {
            vm.totals = totalsSrv.getColumnTotals(vm.lineItems, 'quantity');
            //Trim off any unneeded items
//            delete vm.totals.isSelected;
            delete vm.totals.areaType;
            delete vm.totals.AffectedAreas_id;
        };
        
        activate();
        
        function activate() {
            getTakeoffDetails();
        }
    }
})();