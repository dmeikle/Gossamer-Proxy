(function() {
    'use strict';

    angular
        .module('rootApp')
        .factory('totalsSrv', totalsSrv);

    function totalsSrv($log) {
        
        var service = {
            getColumnTotals: getColumnTotals
        };

        return service;
        
        //Add another row to the lineItems
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
        
    }
})();