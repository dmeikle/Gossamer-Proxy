module.service('companyListSrv', function ($http, searchSrv) {

    var apiPath = '/admin/companies/';

    var self = this;

    self.advancedSearch = {};

    this.getCompanyList = function (row, numRows) {
        return $http.get(apiPath + row + '/' + numRows)
                .then(function (response) {
                    self.companyList = response.data.Companys;
                    self.companyCount = response.data.CompanysCount[0].rowCount;
                });
    };

    this.getCompanyDetail = function (object) {
        return $http.get(apiPath + object.Companies_id)
                .then(function (response) {
                    self.companyDetail = response.data;
                });
    };

    this.search = function (searchObject) {
        return searchSrv.search(searchObject, apiPath).then(function () {
            self.searchResults = searchSrv.searchResults.Companys;
            self.searchResultsCount = searchSrv.searchResults.CompanysCount[0].rowCount;
        });
    };

    this.getAdvancedSearchFilters = function () {
        return searchSrv.getAdvancedSearchFilters('/render/companies/companyAdvancedSearchFilters').then(function () {
            self.advancedSearch.fields = searchSrv.advancedSearch.fields;
        });
    };
});
