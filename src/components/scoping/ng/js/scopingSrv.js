
/* 
     *  This file is part of the Quantum Unit Solutions development package.
     * 
     *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
     * 
     *  For the full copyright and license information, please view the LICENSE
     *  file that was distributed with this source code.
     */
    
    
(function() {
    
    angular
        .module('scopingAdmin')
        .factory('scopingSrv', scopingSrv);

    function scopingSrv(crudSrv, searchSrv) {
        //TODO: change these params
        var apiPath = '/admin/scoping/';
	var objectType = 'Scoping';        
        var apiPathClaimLocation = '/admin/claims/locations/claim/';
        var apiPathClaimContacts = '/admin/claim/contacts/';


        var self = this;
	self.advancedSearch = {};
		
        var service = {
            getList: getList,
	    getRow: getRow,
            save: save,
	    remove: remove,
	    autocomplete: autocomplete,
            search: search,
            getAdvancedSearchFilters: getAdvancedSearchFilters,
            getClaimContacts: getClaimContacts,
            getClaimLocations: getClaimLocations,
            saveScopeWriter: saveScopeWriter,
//            responseList: responseList,
//            responseListCount: responseListCount
        };
        
        return service;
        
        function getList(row, numRows) {
            //can also add optional config to passed params
 	    return crudSrv.getList(apiPath, row, numRows).then(function(response) {
			
            //TODO: change objectTypeList to response object type received
            self.responseList = response.data.Claims;
            self.responseListCount = response.data.Claims[0].rowCount;

            return response;
           });
        }

        function getRow(id) {
	    return crudSrv.getDetails(apiPath, id).then(function(response) {
		//TODO: change objectType to response object type received
                self.details = response.data.Claim;

                return response;
            });
	}

        function save(object) {
            for (var property in object) {
                if (object.hasOwnProperty(property) && 
                    property.substr(property.length - 3) == '_id' && !object[property]) {
                        delete object[property];
                }
            }
            delete object.$hashKey;
            var requestPath;
            if (!object.id || object.id === '') {
                requestPath = apiPath + '0';
            } else {
                requestPath = apiPath + object.id;
            }
            var formToken = object.FORM_SECURITY_TOKEN;

            return crudSrv.save(requestPath, object, objectType, formToken);
        }

        function remove(object) {
            for (var property in object) {
                if (object.hasOwnProperty(property) && property.substr(property.length - 3) == '_id' && 
                        !object[property]) {
                        delete object[property];
                }
            }

            var formToken = object.FORM_SECURITY_TOKEN;

            return crudSrv.save(apiPath + '/remove/' + object.id, object, objectType, formToken);
        }


        function autocomplete(value, type) {
            var config = {};
            config[type] = value;
            //TODO: change unique-uri to match server's expected uri segment
            return searchSrv.fetchAutocomplete(apiPath + 'unique-uri/', config).then(function() {

                return searchSrv.autocomplete.ProjectAddresss;
            });
        }


        function search(searchObject) {
            return searchSrv.search(apiPath, searchObject).then(function() {
                var results = {};
                results.searchResults = searchSrv.searchResults.Claims;
                results.searchResultsCount = searchSrv.searchResults.ClaimsCount[0].rowCount;
                return results;
            });
        }

        function getAdvancedSearchFilters() {
        //TODO: change render-path to required uri - only use this function if we are not already 
        //drawing the search form on page load
            return searchSrv.getAdvancedSearchFilters('/render-path').then(function() {
                    self.advancedSearch.fields = searchSrv.advancedSearch.fields;
            });
        }
        
        // add-ons to template go here
        
        function getClaimLocations(object) {
            return crudSrv.getDetails(apiPathClaimLocation, object.id).then(function(response) {
                return response;
            });
        }
        
        function getClaimContacts(object) {
            return crudSrv.getDetails(apiPathClaimContacts, object.id).then(function(response) {
                return response;
            });
        }
        
        function saveScopeWriter(scopingInstance, formToken) {
            var requestPath = apiPath + 'assign-writer/';
            var objectType = 'ScopingInstance';
            
            return crudSrv.save(requestPath, scopingInstance, objectType, formToken);
        }
    }
})();