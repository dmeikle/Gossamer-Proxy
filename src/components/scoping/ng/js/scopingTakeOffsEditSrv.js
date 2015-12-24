//module.service('scopingTakeOffsEditSrv', function(crudSrv) {
//	var self = this;
//	var apiPath = '/admin/scoping/takeoffs/';
//
//	this.getTakeoffDetails = function(claimsId, claimsLocationsId) {
//		return crudSrv.getDetails(apiPath + 'get/' + claimsId, + '/' + claimsLocationsId).then(function(response) {
//                    self.takeOffDetails = response.data.TakeOff;
//                    return response;
//                });
//	};
//});

(function () {
    'use strict';
    
    angular
        .module('scopingAdmin')
        .factory('scopingTakeOffsEditSrv', scopingTakeOffsEditSrv);
    
    function scopingTakeOffsEditSrv(crudSrv) {
        
        //Define the service and the accessible functions
        var service = {
            getTakeoffDetails: getTakeoffDetails
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
            crudSrv.save(apiPath, lineItems, 'ScopeMaterialTakeoff', formToken);
        }
    }
})();