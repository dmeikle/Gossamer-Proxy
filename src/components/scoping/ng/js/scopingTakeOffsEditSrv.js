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
                return response.data.ScopingMaterialTakeoffSheet[0];
            });
        }
        
        //Save the takeoff sheet
        function save(id, lineItems, Claims_id, ClaimsLocations_id, formToken){
            var data = {};
            data.Claims_id = Claims_id;
            data.ClaimsLocations_id = ClaimsLocations_id;
            crudSrv.saveWithData(apiPath + 'save/' + id, lineItems, 'ScopeMaterialTakeoff', data, formToken);
        }
    }
})();