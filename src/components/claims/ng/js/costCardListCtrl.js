
module.controller('costCardListCtrl', function ($scope, costCardListSrv, $location, tablesSrv) {
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
    
    var Claims_id = document.getElementById('Claims_id').value;
    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;
    
    var path = $location.absUrl();    
    var id = path.substring(path.lastIndexOf("/")+1);
    
    
    // Load up the table service so we can watch it!
    $scope.tablesSrv = tablesSrv;
    
    $scope.$watch('tablesSrv.sortResult', function () {
        $scope.loading = true;
        if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
            $scope.list = tablesSrv.sortResult.CostCards;
            $scope.loading = false;
        }
    });

    $scope.$watchGroup(['tablesSrv.grouped', 'tablesSrv.groupResult.PurchaseOrders'], function () {
        $scope.grouped = tablesSrv.grouped;
        $scope.loading = true;
        if ($scope.grouped === true) {
            if (tablesSrv.groupResult && tablesSrv.groupResult.CostCards)
                $scope.list = tablesSrv.groupResult.CostCards;
            $scope.loading = false;
        } else if ($scope.grouped === false) {
            getList();
        }
    });
    getList();
    function getList() {
        $scope.loading = true;
        $scope.noSearchResults = false;
        costCardListSrv.getList(id, row, numRows)
                .then(function () {
                    $scope.loading = false;
                    $scope.jobNumber = costCardListSrv.jobNumber;
                    $scope.list = costCardListSrv.list;
                    $scope.totalItems = costCardListSrv.listRowCount;
                    if (costCardListSrv.error.showError === true) {
                        $scope.error.showError = true;
                    }
                });
    }

    $scope.$watch('basicSearch.query', function (newVal, oldVal) {
        if ($scope.basicSearch.query.length === 0 && newVal !== oldVal) {
            getList();
        } else if($scope.basicSearch.query.length >= 3){
            $scope.search($scope.basicSearch.query);
        }
    });

//    $scope.$watch('currentPage + itemsPerPage', function () {
//        $scope.loading = true;
//        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
//        numRows = $scope.itemsPerPage;
//        getList(row, numRows);
//    });
//    
    $scope.selectRow = function(row){
        $scope.sidePanelOpen = true;
        $scope.selectedRow = row;
        $scope.sidePanelLoading = true;
        $scope.searching = false;
        
        costCardListSrv.getBreakdown(row.Claims_id, row.id).then(function(){
            $scope.breakdown = costCardListSrv.breakdown;
            $scope.breakdown.CostCards_id = row.id;
            $scope.breakdown.timesheets = $scope.breakdown.timesheets[0];
            $scope.breakdown.eqCosts = $scope.breakdown.eqCosts[0];
            $scope.breakdown.generalCosts = $scope.breakdown.generalCosts[0][0];
            $scope.breakdown.inventoryCosts = $scope.breakdown.inventoryCosts[0];
            $scope.breakdown.purchaseOrders = $scope.breakdown.purchaseOrders[0];
            $scope.sidePanelLoading = false;
        });
    };

    $scope.closeSidePanel = function () {
        $scope.sidePanelOpen = false;
        $scope.selectedRow = {};
    };
    
    //Search
    $scope.search = function (searchObject) {
        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            costCardListSrv.search(copiedObject).then(function () {
                $scope.list = costCardListSrv.searchResults;
                $scope.totalItems = costCardListSrv.searchResultsCount;
                if ($scope.totalItems === 0) {
                    $scope.noSearchResults = true;
                }
                $scope.loading = false;
            });
        }
    };
    
    $scope.advancedSearch = function (searchObject) {
        $scope.loading = true;
        $scope.noSearchResults = false;
        searchObject.Claims_id = Claims_id;
        costCardListSrv.advancedSearch(searchObject).then(function () {
            $scope.list = costCardListSrv.advancedSearchResults;
//            $scope.totalItems = costCardListSrv.advancedSearchResultsCount;
//            if ($scope.totalItems === '0') {
//                $scope.noSearchResults = true;
//            }
            $scope.loading = false;
        });
    };
    
    $scope.resetSearch = function () {
        $scope.searchSubmitted = false;
        $scope.noSearchResults = false;
        $scope.basicSearch.query = '';
        getList();
    };
    
    $scope.resetAdvancedSearch = function () {
        $scope.searchSubmitted = false;
        $scope.advSearch = {};
        getList();
    };
    
    $scope.openAdvancedSearch = function () {
        $scope.sidePanelOpen = true;
        $scope.loading = false;
        $scope.searching = true;
        $scope.selectedRow = {};
    };
    
    //Date Picker
    $scope.dateOptions = {'starting-day': 1};
    $scope.openDatepicker = function (event, datepicker) {
        $scope.isOpen.datepicker[datepicker] = true;
    };
});