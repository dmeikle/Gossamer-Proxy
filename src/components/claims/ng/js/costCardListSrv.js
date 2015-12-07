// Inventory service
module.service('costCardListSrv', function ($http, searchSrv, $filter, crudSrv) {
    var apiPath = '/admin/claims/costcards/';
    var totalsPath = '/admin/claims/costcards/totals/';
    
    var self = this;
    self.error = {};
    self.error.showError = false;

    //Get the list of inventory items
    this.getList = function (id, row, numRows) {
        return $http.get(apiPath + id + '/'  + row + '/' + numRows)
                .then(function (response) {
                    self.list = response.data.CostCards;
//                    self.listRowCount = response.data.PurchaseOrdersCount[0].rowCount;
                }, function (response) {
                    //Handle any errors
                    self.error.showError = true;
                });
    };
    
//    //Search
//    this.search = function (searchObject) {
//        return $http({
//            url: apiPath + '0/20?name=' + searchObject,
//            method: 'GET'
//        }).then(function (response) {
//            self.searchResults = response.data.PurchaseOrders;
//            self.searchResultsCount = response.data.PurchaseOrdersCount[0].rowCount;
//        });
//    };
//    
//    this.advancedSearch = function (searchObject) {
//        var config = angular.copy(searchObject);
//            config.toDate = $filter('date')(config.toDate, 'yyyy-MM-dd', '+0000');
//            config.fromDate = $filter('date')(config.fromDate, 'yyyy-MM-dd', '+0000');
//        return $http({
//            url: apiPath + 'search/0/20?',
//            method: 'GET',
//            params: config
//        }).then(function (response) {
//            self.advancedSearchResults = response.data.PurchaseOrders;
//            self.advancedSearchResultsCount = response.data.PurchaseOrdersCount[0].rowCount;
//        });
//    };
//    
    this.getBreakdown = function(Claims_id, CostCard_id){
        return $http({
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: totalsPath + Claims_id + '/' + CostCard_id
        }).then(function (response) {
            self.breakdown = response.data;
//            self.breakdownLineItems = response.data;
        });
    };
});