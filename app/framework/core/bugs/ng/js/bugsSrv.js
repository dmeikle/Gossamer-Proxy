    /* 
     *  This file is part of the Quantum Unit Solutions development package.
     * 
     *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
     * 
     *  For the full copyright and license information, please view the LICENSE
     *  file that was distributed with this source code.
     */
    
    
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
        .module('bugsAdmin')
        .factory('bugsSrv', bugsSrv);

    function bugsSrv(crudSrv, searchSrv) {
        //TODO: change these params
        var apiPath = '/admin/bugs/';
	var objectType = 'Bug';

        var self = this;
	self.advancedSearch = {};
		
        var service = {
            getList: getList,
	    getRow: getRow,
            save: save,
	    remove: remove,
	    autocomplete: autocomplete,
            search: search,
            getAdvancedSearchFilters: getAdvancedSearchFilters
        };
        
        return service;
        
        function getList(row, numRows) {
            //can also add optional config to passed params
 	    return crudSrv.getList(apiPath, row, numRows).then(function(response) {
			
            //TODO: change objectTypeList to response object type received
            self.responseList = response.data.Bugs;
            self.responseListCount = response.data.Bugs[0].rowCount;

            return response;
           });
        }

        function getRow(id) {
	        return crudSrv.getDetails(apiPath, id).then(function(response) {
		//TODO: change objectType to response object type received
                self.details = response.data.Bug;

                return response;
            });
	}

        function save(object, formToken) {
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
            return searchSrv.search(apiPath, searchObject);
        }

        function getAdvancedSearchFilters() {
        //TODO: change render-path to required uri - only use this function if we are not already 
        //drawing the search form on page load
            return searchSrv.getAdvancedSearchFilters('/render-path').then(function() {
                    self.advancedSearch.fields = searchSrv.advancedSearch.fields;
            });
        }
    }
})();