module.controller('inventoryCtrl', function($scope, costCardItemTypeSrv, templateSrv, inventorySrv, $modal) {
    // Stuff to run on controller load
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;    
    $scope.loading = true;
    $scope.previouslyClickedObject = {};
    $scope.noSearchResults = false;

    $scope.basicSearch = {};
    $scope.advancedSearch = {};
//    $scope.advSearch = {};
//    $scope.autocomplete = {};
    $scope.isOpen = {};
    $scope.isOpen.datepicker = {};
    $scope.isOpen.datepicker.fromDate = false;
    $scope.isOpen.datepicker.toDate = false;

    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;    

    function getList(){
        $scope.loading = true;
        $scope.noSearchResults = false;

        inventorySrv.getList(row,numRows)
            .then(function(){
            $scope.loading = false;
            $scope.list = inventorySrv.list;
            $scope.totalItems = inventorySrv.listRowCount;
            if(inventorySrv.error.showError === true){
                $scope.error.showError = true;
                //$scope.error.message = 'Could not reach the database, please try again.';
            }
        });
    }

    $scope.$watch('currentPage + itemsPerPage', function() {
        $scope.loading = true;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;
        getList(row, numRows);
    });

    //Select Rows for breakdown view
    $scope.selectRow = function(clickedObject) {
        $scope.searching = false;
        if ($scope.previouslyClickedObject !== clickedObject) {
            $scope.previouslyClickedObject = clickedObject;
            $scope.sidePanelOpen = true;
            $scope.sidePanelLoading = true;
            inventorySrv.getBreakdown(row, numRows, clickedObject.id)
                .then(function(){
//                    $scope.sidePanelOpen = true;
                $scope.selectedRow = clickedObject;
                $scope.rowBreakdown = inventorySrv.breakdownItems;
                $scope.sidePanelLoading = false;
            });
        }
    };

    $scope.closeSidePanel = function() {
//        if ($scope.searching) {
//            $scope.searching = false;
//        }
//        if ($scope.selectedStaff) {
//            $scope.selectedStaff = undefined;
//            $scope.previouslyClickedObject = undefined;
//        }
//        if (!$scope.selectedStaff && !$scope.searching) {
//            $scope.sidePanelOpen = false;
//            $scope.previouslyClickedObject = {};
//        }
        $scope.sidePanelOpen = false;
        $scope.isOpen.datepicker.fromDate = false;
        $scope.isOpen.datepicker.toDate = false;
    };

    //Search
    $scope.search = function(searchObject) {
        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            generalCostsSrv.search(copiedObject).then(function() {
                $scope.generalCostsList = generalCostsSrv.searchResults;
                $scope.totalItems = generalCostsSrv.searchResultsCount;
                $scope.loading = false;
            });
        }
    };

    $scope.advancedSearch = function(searchObject){
        $scope.loading = true;
        $scope.noSearchResults = false;
        generalCostsSrv.advancedSearch(searchObject).then(function(){
            $scope.generalCostsList = generalCostsSrv.advancedSearchResults;
            $scope.totalItems = generalCostsSrv.advancedSearchResultsCount;
            if($scope.totalItems === '0'){
                $scope.noSearchResults = true;
            }
            $scope.loading = false;
        });
    };

    $scope.resetSearch = function() {
        $scope.searchSubmitted = false;
        $scope.basicSearch.query = '';
        getGeneralCostsList();
    };
    
    $scope.autoSearch = function(searchString){
        if(searchString.length >= 3){
            $scope.search(searchString);
        }
    };

    $scope.resetAdvancedSearch = function() {
        $scope.searchSubmitted = false;
        $scope.advSearch = {};
        getGeneralCostsList();
    };

    $scope.openAdvancedSearch = function() {
        $scope.sidePanelOpen = true;
        $scope.selectedTimesheet = undefined;
        $scope.searching = true;
    };
    
    //Date Picker
    $scope.dateOptions = {'starting-day':1};

    $scope.openDatepicker = function(event, datepicker){
        $scope.isOpen.datepicker[datepicker] = true;
    };
    
    //Modal
    $scope.openModal = function() {
        //console.log(generalCost);
        $scope.modalLoading = true;
        var template = templateSrv.inventoryModal;
        var modal = $modal.open({
            templateUrl: template,
            controller: 'inventoryModalCtrl',
            size: 'lg',
//            resolve: {
//                generalCost: function () {
//                    return generalCost;
//                }
//            }
        });
        modal.opened.then(function(){
            $scope.modalLoading = false;
        });
        modal.result.then(function(){
            getGeneralCostsList();
        });
    };
});