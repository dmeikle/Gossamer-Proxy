module.service('searchSrv', function ($http) {

    var self = this;

    this.advancedSearch = {};

    this.searchCall = function (object, apiPath) {
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

    this.search = function (object, apiPath) {
        return self.searchCall(object, apiPath + 'search').then(function (response) {
            self.searchResults = response.data;
            self.searchResultsCount = response.data;
        });
    };

    this.getAdvancedSearchFilters = function (apiPath) {
        return $http.get(apiPath).then(function (response) {
            var elementList = document.implementation.createHTMLDocument('filters');
            elementList.body.innerHTML = response.data;
            self.advancedSearch.fields = [];
            for (var i = 0; i < elementList.body.children.length; i++) {
                self.advancedSearch.fields.push(elementList.body.children[i]);
            }
        });
    };

    this.sortByColumn = function (config, apiPath) {
        return $http({
            url: apiPath,
            method: 'GET',
            params: config
        }).then(function (response) {
            self.sortResult = response.data;
        });
    };

    this.fetchAutocomplete = function (config, apiPath) {
        return self.searchCall(config, apiPath + 'search').then(function (response) {
            self.autocomplete = response.data;
        });
    };
});
