(function () {
    'use strict';
    
    angular
        .module('scopingAdmin')
        .factory('scopingTakeOffsEditSrv', scopingTakeOffsEditSrv);
    
    function scopingTakeOffsEditSrv(crudSrv, $log) {
        
        //Define the service and the accessible functions
        var service = {
            getTakeoffDetails: getTakeoffDetails,
            save: save,
            mapTakeoffItems: mapTakeoffItems,
            setVariants: setVariants,
            setNewLineItems: setNewLineItems
        };
        
        var apiPath = '/admin/scoping/takeoffs/';
        //Service Variables
        return service;        
        
        //Get the takeoff sheet details
        function getTakeoffDetails(claimsId, claimsLocationsId) {
            return crudSrv.getDetails(apiPath + 'get/' + claimsId, '/' + claimsLocationsId).then(function(response) {
                return response.data;
            });
        }
        
        //Save the takeoff sheet
        function save(id, lineItems, Claims_id, ClaimsLocations_id, formToken){
            var data = {};
            data.Claims_id = Claims_id;
            data.ClaimsLocations_id = ClaimsLocations_id;
            
            //If the id is greater than 0, then we want to set the item ids for each item in the line items
            if(id > 0) {
                data.id = id;
                setItemIDs(id, lineItems);
            }
            
            return crudSrv.saveWithData(apiPath + 'save/' + id, lineItems, 'ScopeMaterialTakeoff', data, formToken);
        }
        
        //Set the variant names for items with variant options
        function setVariants(lineItems, insulationVariants, jBeadVariants){
            for(var i in lineItems) {
                for(var j in lineItems[i]) {
                    switch(j) {
                        case 'insulation':
                            for(var k in insulationVariants) {
                                if(lineItems[i][j].VariantOptions_id && lineItems[i][j].VariantOptions_id === insulationVariants[k].VariantOptions_id) {
                                    lineItems[i][j].variant = insulationVariants[k].variant;
                                }
                            }
                            break;
                        case 'jBead':
                            for(var p in jBeadVariants) {
                                if(lineItems[i][j].VariantOptions_id && lineItems[i][j].VariantOptions_id === jBeadVariants[p].VariantOptions_id) {
                                    lineItems[i][j].variant = jBeadVariants[p].variant;
                                }
                            }
                            break;
                    }
                }
            }
        }
        
        function mapTakeoffItems(id, areaTypes, takeoffItems, template){
            var lineItems = [];
            takeoffItems = Object.keys(takeoffItems).map(function (key) {return takeoffItems[key];});
            
            for(var i = 0; i < areaTypes.length; i++) {
                lineItems.push(angular.copy(template));
                lineItems[i].areaType = areaTypes[i].areaType;
                lineItems[i].AffectedAreas_id = areaTypes[i].AffectedAreas_id;
                for(var u in lineItems[i]) {
                    if(typeof lineItems[i][u] === 'object') {
                        lineItems[i][u].AffectedAreas_id = areaTypes[i].AffectedAreas_id;                        
                    }
                }
            }
            
            for(i in takeoffItems) {
                for(var j in takeoffItems[i]) {
                    for(var p in lineItems) {                    
                        if(takeoffItems[i][j].AffectedAreas_id === lineItems[p].AffectedAreas_id) {
                            for(var k in template) {
                                if(takeoffItems[i][j].InventoryItems_id === template[k].InventoryItems_id) {
                                    takeoffItems[i][j].areaType = lineItems[p].areaType;
                                    lineItems[p][k] = takeoffItems[i][j];
                                }
                            }
                        }
                    }
                }
            }
            
            return lineItems;
        }
        
        function setNewLineItems(areaTypes, template){
            var lineItems = [];
            
            for(var i = 0; i < areaTypes.length; i++) {
                lineItems.push(angular.copy(template));
                lineItems[i].areaType = areaTypes[i].areaType;
                lineItems[i].AffectedAreas_id = areaTypes[i].AffectedAreas_id;
                for(var u in lineItems[i]) {
                    if(typeof lineItems[i][u] === 'object') {
                        lineItems[i][u].AffectedAreas_id = areaTypes[i].AffectedAreas_id;                        
                    }
                }
            }
            
            return lineItems;
        }
        
        function setItemIDs(id, lineItems){
            for(var i in lineItems) {
                for(var j in lineItems[i]) {
                    if(typeof lineItems[i][j] === 'object') {
                        lineItems[i][j].ScopingMaterialTakeoffSheets_id = id;                        
                    }
                }
            }
        }
    }
})();