(function() {
    'use strict';

    angular
        .module('rootApp')
        .factory('tableControlsSrv', tableControlsSrv);

    function tableControlsSrv() {
        
        var service = {
            addRow: addRow,
            insertRows: insertRows,
            removeRows: removeRows,
            selectAll: selectAll,
            checkSelected: checkSelected,
            checkSelectAll: checkSelectAll
        };

        return service;
        
        //Add another row to the lineItems
        function addRow(lineItems, newLineItem) {
            lineItems.push(newLineItem);
            return lineItems;
        }
        
        //Insert row(s) after items where isSelected = true
        function insertRows(lineItems, newLineItem) {
            for(var i = lineItems.length-1; i >= 0; i--){
                if (lineItems[i].isSelected === true) {
                    lineItems.splice(parseInt(i) + 1, 0, newLineItem);
                }
            }
            return lineItems;
        }
        
        //Remove any rows that where isSelected = true
        function removeRows(lineItems) {
            for (var i = lineItems.length - 1; i >= 0; i--) {
                if (lineItems[i].isSelected === true) {
                    lineItems.splice(parseInt(i), 1);
                }
            }
            return lineItems;
        }
        
        //Selects all items in the lineItems
        function selectAll(lineItems, value) {
            for(var i in lineItems){
                lineItems[i].isSelected = value;
            }
            return lineItems;
        }
        
        function checkSelected(lineItems) {
            var rowSelected = false;
            
            for(var i in lineItems){
                if(lineItems[i].isSelected === true){
                    rowSelected = true;
                    break;
                } else {
                    rowSelected = false;
                }
           }
           
           return rowSelected;
        }
        
        function checkSelectAll(lineItems) {
            var allSelected = false;
            
            for(var i in lineItems){
                if(lineItems[i].isSelected === false){
                    allSelected = false;
                    break;
                } else {
                    allSelected = true;
                }
           }
           
           return allSelected;
        }
    }
})();