(function () {
    'use strict';
    
    angular
        .module('scopingAdmin')
        .factory('scopingTakeOffsEditSrv', scopingTakeOffsEditSrv);
    
    function scopingTakeOffsEditSrv(crudSrv) {
        
        //Define the service and the accessible functions
        var service = {
            getTakeoffDetails: getTakeoffDetails,
            save: save
        };
        
        var apiPath = '/admin/scoping/takeoffs/';
        //Service Variables
        return service;
        
        
        //Get the takeoff sheet details
        function getTakeoffDetails(claimsId, claimsLocationsId) {
            return crudSrv.getDetails(apiPath + 'get/' + claimsId, '/' + claimsLocationsId).then(function(response) {
                return response.data.TakeOff;
            });
        }
        
        function save(lineItems, formToken){
            crudSrv.save(apiPath + 'save/' + lineItems.id, lineItems, 'ScopeMaterialTakeoff', formToken);
        }
    }
})();