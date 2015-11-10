module.service('subcontractorsListSrv', function($http, searchSrv) {

    var apiPath = '/admin/subcontractors/';

    var self = this;

    self.advancedSearch = {};

    this.getSubcontractorList = function(row, numRows) {
        return $http.get(apiPath + row + '/' + numRows)
            .then(function(response) {
                self.subcontractorsList = response.data.Subcontractors;
                self.subcontractorsCount = response.data.SubcontractorsCount[0].rowCount;
            });
    };

    this.getSubcontractorDetail = function(object) {
        return $http.get(apiPath + object.Subcontractors_id)
            .then(function(response) {
                self.subcontractorsDetail = response.data;
            });
    };

    this.search = function(searchObject) {
        return searchSrv.search(apiPath, searchObject).then(function() {
            self.searchResults = searchSrv.searchResults.Subcontractors;
            self.searchResultsCount = searchSrv.searchResults.SubcontractorsCount[0].rowCount;
        });
    };

    this.getAdvancedSearchFilters = function() {
        return searchSrv.getAdvancedSearchFilters('/render/subcontractors/subcontractorsAdvancedSearchFilters').then(function() {
            self.advancedSearch.fields = searchSrv.advancedSearch.fields;
        });
    };
});