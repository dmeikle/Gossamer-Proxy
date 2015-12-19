module.service('searchSrv', function($http) {

    var self = this;

    this.advancedSearch = {};


    this.searchCall = function(apiPath, object) {

        config = {};
        for (var param in object) {
            if (object.hasOwnProperty(param)) {
                config[param] = object[param];
            }
        }

        return $http({
            url: apiPath,
            method: 'GET',
            params: config
        });
    };


    this.search = function(apiPath, object, page, numRows) {

        if (page !== undefined && numRows !== undefined) {
            apiPath += 'search/' + page + '/' + numRows;
        } else {
            apiPath += 'search';
        }

        return self.searchCall(apiPath, object).then(function(response) {

            self.searchResults = response.data;
            self.searchResultsCount = response.data;

            return response;
        });
    };

    this.getAdvancedSearchFilters = function(apiPath) {
        return $http.get(apiPath).then(function(response) {
            var elementList = document.implementation.createHTMLDocument('filters');
            elementList.body.innerHTML = response.data;
            self.advancedSearch.fields = [];
            for (var i = 0; i < elementList.body.children.length; i++) {
                self.advancedSearch.fields.push(elementList.body.children[i]);
            }
        });
    };


    this.sortByColumn = function(apiPath, config) {

        return $http({
            url: apiPath,
            method: 'GET',
            params: config
        }).then(function(response) {
            self.sortResult = response.data;
        });
    };

    this.fetchAutocomplete = function(apiPath, config) {
        return self.searchCall(apiPath + 'search', config).then(function(response) {

            self.autocomplete = response.data;
            
            return response;
        });
    };
    
    this.fetchAutocompleteNoSearch = function(apiPath, config) {
        return self.searchCall(apiPath, config).then(function(response) {

            self.autocomplete = response.data;
            return response;
        });
    };

    this.autocomplete = function(apiPath, config) {
        return self.searchCall(apiPath + 'autocomplete', config);
    };
});