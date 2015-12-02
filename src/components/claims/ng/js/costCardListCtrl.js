
module.controller('costCardListCtrl', function ($scope, costCardListSrv, $location) {
    // Stuff to run on controller load
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;
    $scope.loading = true;
    $scope.previouslyClickedObject = {};
    $scope.noSearchResults = false;

    $scope.basicSearch = {};
    $scope.advancedSearch = {};
    $scope.advSearch = {};
    $scope.basicSearch.query = '';
    $scope.isOpen = {};
    $scope.isOpen.datepicker = {};
    $scope.isOpen.datepicker.fromDate = false;
    $scope.isOpen.datepicker.toDate = false;
    
    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;
    
    var path = $location.absUrl();    
    var id = path.substring(path.lastIndexOf("/")+1);
    
    
//    // Load up the table service so we can watch it!
//    $scope.tablesSrv = tablesSrv;
//    
//    $scope.$watch('tablesSrv.sortResult', function () {
//        if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
//            $scope.list = tablesSrv.sortResult.PurchaseOrders;
//            $scope.loading = false;
//        }
//    });
//
//    $scope.$watchGroup(['tablesSrv.grouped', 'tablesSrv.groupResult.PurchaseOrders'], function () {
//        $scope.grouped = tablesSrv.grouped;
//        if ($scope.grouped === true) {
//            if (tablesSrv.groupResult && tablesSrv.groupResult.PurchaseOrders)
//                $scope.list = tablesSrv.groupResult.PurchaseOrders;
//            $scope.loading = false;
//        } else if ($scope.grouped === false) {
//            getList();
//        }
//    });
    getList();
    function getList() {
        $scope.loading = true;
        $scope.noSearchResults = false;
        costCardListSrv.getList(id, row, numRows)
                .then(function () {
                    $scope.loading = false;
                    $scope.list = costCardListSrv.list;
                    $scope.totalItems = costCardListSrv.listRowCount;
                    if (costCardListSrv.error.showError === true) {
                        $scope.error.showError = true;
                    }
                });
    }

//    $scope.$watch('basicSearch.query', function (newVal, oldVal) {
//        if ($scope.basicSearch.query.length === 0 && newVal !== oldVal) {
//            getList();
//        } else if($scope.basicSearch.query.length >= 3){
//            $scope.search($scope.basicSearch.query);
//        }
//    });
//
//    $scope.$watch('currentPage + itemsPerPage', function () {
//        $scope.loading = true;
//        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
//        numRows = $scope.itemsPerPage;
//        getList(row, numRows);
//    });
//    
//    $scope.selectRow = function(row){
//        $scope.sidePanelOpen = true;
//        $scope.selectedRow = row;
//        $scope.sidePanelLoading = true;
//        $scope.searching = false;
//        
//        posSrv.getBreakdown(row.PurchaseOrders_id).then(function(){
//            $scope.breakdown = posSrv.breakdown;
//            $scope.breakdownLineItems = posSrv.breakdownLineItems;
//            $scope.sidePanelLoading = false;
//        });
//    };
//
//    $scope.closeSidePanel = function () {
//        $scope.sidePanelOpen = false;
//        $scope.selectedRow = {};
//    };
//    
//    //Search
//    $scope.search = function (searchObject) {
//        $scope.noResults = undefined;
//        var copiedObject = angular.copy(searchObject);
//        if (copiedObject && Object.keys(copiedObject).length > 0) {
//            $scope.searchSubmitted = true;
//            $scope.loading = true;
//            posSrv.search(copiedObject).then(function () {
//                $scope.list = posSrv.searchResults;
//                $scope.totalItems = posSrv.searchResultsCount;
//                if ($scope.totalItems === 0) {
//                    $scope.noSearchResults = true;
//                }
//                $scope.loading = false;
//            });
//        }
//    };
//    
//    $scope.advancedSearch = function (searchObject) {
//        $scope.loading = true;
//        $scope.noSearchResults = false;
//        posSrv.advancedSearch(searchObject).then(function () {
//            $scope.list = posSrv.advancedSearchResults;
//            $scope.totalItems = posSrv.advancedSearchResultsCount;
//            if ($scope.totalItems === '0') {
//                $scope.noSearchResults = true;
//            }
//            $scope.loading = false;
//        });
//    };
//    
//    $scope.resetSearch = function () {
//        $scope.searchSubmitted = false;
//        $scope.noSearchResults = false;
//        $scope.basicSearch.query = '';
//        getList();
//    };
//    
//    $scope.resetAdvancedSearch = function () {
//        $scope.searchSubmitted = false;
//        $scope.advSearch = {};
//        getList();
//    };
//    
//    $scope.openAdvancedSearch = function () {
//        $scope.sidePanelOpen = true;
//        $scope.selectedTimesheet = undefined;
//        $scope.searching = true;
//        $scope.selectedRow = {};
//    };
//    
//    //Date Picker
//    $scope.dateOptions = {'starting-day': 1};
//    $scope.openDatepicker = function (event, datepicker) {
//        $scope.isOpen.datepicker[datepicker] = true;
//    };
});