// Timesheet service
module.service('generalCostsSrv', function($http, searchSrv, $filter) {
    var apiPath = '/admin/accounting/generalcosts/';
    var generalCostItemsPath = '/admin/accounting/generalcostitems/';
    
    var self = this;
    
    self.error = {};
    self.error.showError = false;
    
    //Get the list of general cost items
    this.getGeneralCostsList = function(row, numRows){
        return $http.get(generalCostItemsPath + row + '/' + numRows)
            .then(function(response) {
            console.log(response);
            self.generalCostsList = response.data.AccountingGeneralCostItems;
            self.generalCostsCount = response.data.AccountingGeneralCostItemsCount[0].rowCount;
        }, function(response){
            //Handle any errors
            self.error.showError = true;
        });
    };
    
    this.search = function(searchObject) {
        var config = {};
        config.name = searchObject;
        console.log(config);
        return $http({
            url: apiPath + 'search?',
            method: 'GET',
            params: config
        }).then(function(){            
            self.searchResults = searchSrv.searchResults.GeneralCosts;
            self.searchResultsCount = searchSrv.searchResults.GeneralCostsCount[0].rowCount;
        });
    };
    
    this.advancedSearch = function(searchObject) {
        var config = angular.copy(searchObject);
        config.toDate = $filter('date')(config.toDate, 'yyyy-MM-dd', '+0000');
        config.fromDate = $filter('date')(config.fromDate, 'yyyy-MM-dd', '+0000');
        return $http({
            url: apiPath + 'search?',
            method: 'GET',
            params: config
        })
        .then(function(response) {
            console.log(response);
            self.advancedSearchResults = response.data.GeneralCosts;
            self.advancedSearchResultsCount = response.data.GeneralCostsCount[0].rowCount;
        });
    };
});