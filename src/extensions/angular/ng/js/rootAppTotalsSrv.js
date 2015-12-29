(function() {
    'use strict';

    angular
        .module('rootApp')
        .factory('totalsSrv', totalsSrv);

    function totalsSrv($log) {
        
        var service = {
            getColumnTotals: getColumnTotals,
            getRowTotals: getRowTotals
        };

        return service;
        
        //Get the column totals
        function getColumnTotals(lineItems, key) {
            var totals = {};
            for(var i in lineItems) {
                for(var j in lineItems[i]){
                    if(lineItems[i][j][key]){
                        if(totals[j]){
                            totals[j] += parseFloat(lineItems[i][j][key]);
                        } else {                            
                            totals[j] = parseFloat(lineItems[i][j][key]);
                        }
                    } else {
                        if(totals[j]){
                            totals[j] += 0;
                        } else {                            
                            totals[j] = 0;
                        }
                    }
                }
            }
            return totals;
        }       
        
        //Goes through each line items and returns the total for each row as 'rowTotal'
        function getRowTotals(lineItems, key) {
            for(var i in lineItems){
                lineItems[i].rowTotal = 0;
                for(var j in lineItems[i]){
                    lineItems[i].rowTotal += lineItems[i][j][key];
                }
            }
            return lineItems;
        }
    }
})();