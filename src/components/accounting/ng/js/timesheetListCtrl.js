module.controller('timesheetListCtrl', function($scope, $modal, costCardItemTypeSrv, accountingTemplateSrv, timesheetSrv) {
    // Stuff to run on controller load
    //$scope.rowsPerPage = 20;
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;    
    $scope.loading = true;
    $scope.previouslyClickedObject = {};
    $scope.noSearchResults = false;
    
    $scope.basicSearch = {};
    $scope.advancedSearch = {};
    $scope.autocomplete = {};
    $scope.isOpen = {};
    
    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;    
    
    function getTimesheetList(){
        $scope.loading = true;
        $scope.noSearchResults = false;
        console.log(row + ' ' + numRows);
        
        timesheetSrv.getTimesheetList(row,numRows)
            .then(function(){
                $scope.loading = false;
                $scope.timesheetList = timesheetSrv.timesheetList;
                $scope.totalItems = timesheetSrv.timesheetCount;
                console.log($scope.totalItems);
                if(timesheetSrv.error.showError === true){
                    $scope.error.showError = true;
                    //$scope.error.message = 'Could not reach the database, please try again.';
                }
        });
    }
       
    $scope.$watch('currentPage + itemsPerPage', function() {
        $scope.loading = true;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;

        getTimesheetList(row, numRows);
    });
    
    //Modals
    $scope.openTimesheetModal = function(timesheet) {
        $scope.modalLoading = true;

        var template = accountingTemplateSrv.timesheetModal;

        var modal = $modal.open({
            templateUrl: template,
            controller: 'timesheetModalCtrl',
            size: 'lg',
            resolve: {
                timesheet: function () {
                    return timesheet;
                }
            }
        });
        modal.opened.then(function(){
            $scope.modalLoading = false;
        });
        modal.result.then(function(timesheet){
            getTimesheetList();
        });
    };
    
    //Select Rows for breakdown view
    $scope.selectRow = function(clickedObject) {
        $scope.searching = false;
        if ($scope.previouslyClickedObject !== clickedObject) {
            $scope.previouslyClickedObject = clickedObject;
            $scope.sidePanelOpen = true;
            $scope.sidePanelLoading = true;
            timesheetSrv.getTimesheetDetail(clickedObject)
                .then(function(){
//                    $scope.sidePanelOpen = true;
                    $scope.selectedTimesheet = clickedObject;
                    $scope.timesheetBreakdown = timesheetSrv.timesheetBreakdown;
                    $scope.sidePanelLoading = false;
                });
        }
    };
    
    $scope.closeSidePanel = function() {
        if ($scope.searching) {
            $scope.searching = false;
        }
        if ($scope.selectedStaff) {
            $scope.selectedStaff = undefined;
            $scope.previouslyClickedObject = undefined;
        }
        if (!$scope.selectedStaff && !$scope.searching) {
            $scope.sidePanelOpen = false;
            $scope.previouslyClickedObject = {};
        }
        $scope.isOpen.datepicker = false;
    };
    
    //Typeahead
    $scope.fetchAutocomplete = function(viewVal) {
        var searchObject = {};
        searchObject.name = viewVal;
        return timesheetSrv.fetchAutocomplete(searchObject);
    };
    
    //Search
    $scope.search = function(searchObject) {
        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            timesheetSrv.search(copiedObject).then(function() {
                $scope.timesheetList = timesheetSrv.searchResults;
                $scope.totalItems = timesheetSrv.searchResultsCount;
                $scope.loading = false;
            });
        }
    };
    
    $scope.advancedSearch = function(searchObject){
        $scope.loading = true;
        $scope.noSearchResults = false;
        timesheetSrv.advancedSearch(searchObject).then(function(){
            $scope.timesheetList = timesheetSrv.advancedSearchResults;
            $scope.totalItems = timesheetSrv.advancedSearchResultsCount;
            if($scope.totalItems === '0'){
                $scope.noSearchResults = true;
            }
            $scope.loading = false;
        });
    };
    
    $scope.resetSearch = function() {
        $scope.searchSubmitted = false;
        $scope.basicSearch.query = {};
        getTimesheetList();
    };
    
    $scope.resetAdvancedSearch = function() {
        console.log('resetting search');
        $scope.searchSubmitted = false;
        $scope.advSearch = {};
        getTimesheetList();
    };
    
    $scope.openTimesheetAdvancedSearch = function() {
        $scope.sidePanelOpen = true;
        $scope.selectedTimesheet = undefined;
        $scope.searching = true;
    };
    
    //Date Picker
    $scope.dateOptions = {'starting-day':1};
    $scope.openDatepicker = function(eventz){
        $scope.isOpen.datepicker = true;
    };
});
