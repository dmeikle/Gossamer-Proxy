module.controller('timesheetListCtrl', function ($scope, $modal, costCardItemTypeSrv, accountingTemplateSrv, timesheetSrv, tablesSrv) {
    // Stuff to run on controller load
    //$scope.rowsPerPage = 20;
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;
    $scope.loading = true;
    $scope.previouslyClickedObject = {};
    $scope.noSearchResults = false;

    $scope.basicSearch = {};
    $scope.advSearch = {};
    $scope.autocomplete = {};
    $scope.isOpen = {};

    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    
    // Load up the table service so we can watch it!
    $scope.tablesSrv = tablesSrv;
    
    $scope.$watch('tablesSrv.sortResult', function () {
        if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
            $scope.timesheetList = tablesSrv.sortResult.Timesheets;
            $scope.loading = false;
        }
    });

    $scope.$watchGroup(['tablesSrv.grouped', 'tablesSrv.groupResult.Timesheets'], function () {
        $scope.grouped = tablesSrv.grouped;
        if ($scope.grouped === true) {
            if (tablesSrv.groupResult && tablesSrv.groupResult.Timesheets)
                $scope.timesheetList = tablesSrv.groupResult.Timesheets;
            $scope.loading = false;
        } else if ($scope.grouped === false) {
            getTimesheetList();
        }
    });

    function getTimesheetList() {
        $scope.loading = true;
        $scope.noSearchResults = false;

        timesheetSrv.getTimesheetList(row, numRows)
                .then(function () {
                    $scope.loading = false;
                    $scope.timesheetList = timesheetSrv.timesheetList;
                    $scope.totalItems = timesheetSrv.timesheetCount;

                    if (timesheetSrv.error.showError === true) {
                        $scope.error.showError = true;
                        //$scope.error.message = 'Could not reach the database, please try again.';
                    }
                });
    }

    $scope.$watch('currentPage + itemsPerPage', function () {
        $scope.loading = true;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;

        getTimesheetList(row, numRows);
    });

    //Modals
    $scope.openTimesheetModal = function (timesheet) {
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
        modal.opened.then(function () {
            $scope.modalLoading = false;
        });
        modal.result.then(function (timesheet) {
            getTimesheetList();
        });
    };

    //Select Rows for breakdown view
    $scope.selectRow = function (clickedObject) {
        $scope.searching = false;
        if ($scope.previouslyClickedObject !== clickedObject) {
            $scope.previouslyClickedObject = clickedObject;
            $scope.sidePanelOpen = true;
            $scope.sidePanelLoading = true;
            timesheetSrv.getTimesheetDetail(clickedObject)
                    .then(function () {
//                    $scope.sidePanelOpen = true;
                        $scope.selectedTimesheet = clickedObject;
                        $scope.timesheetBreakdown = timesheetSrv.timesheetBreakdown;
                        $scope.sidePanelLoading = false;
                    });
        }
    };

    $scope.closeSidePanel = function () {
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
    $scope.fetchAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.name = viewVal;
        return timesheetSrv.fetchAutocomplete(searchObject);
    };
    
    //Claims Typeahead
    $scope.fetchClaimsAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.jobNumber = viewVal;
        return timesheetSrv.fetchClaimsAutocomplete(searchObject);
    };
    
    $scope.getClaimsID = function(claim){
        $scope.advSearch.jobNumber = claim.jobNumber;
    };
    //Search
    $scope.search = function (searchObject) {
        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            timesheetSrv.search(copiedObject).then(function () {
                $scope.timesheetList = timesheetSrv.searchResults;
                $scope.totalItems = timesheetSrv.searchResultsCount;
                $scope.loading = false;
            });
        }
    };

    $scope.advancedSearch = function (searchObject) {
        $scope.loading = true;
        $scope.noSearchResults = false;
        timesheetSrv.advancedSearch(searchObject).then(function () {
            $scope.timesheetList = timesheetSrv.advancedSearchResults;
            $scope.totalItems = timesheetSrv.advancedSearchResultsCount;
            if ($scope.totalItems === '0') {
                $scope.noSearchResults = true;
            }
            $scope.loading = false;
        });
    };

    $scope.resetSearch = function () {
        $scope.searchSubmitted = false;
        $scope.basicSearch.query = {};
        getTimesheetList();
    };

    $scope.resetAdvancedSearch = function () {

        $scope.searchSubmitted = false;
        $scope.advSearch = {};
        getTimesheetList();
    };

    $scope.openTimesheetAdvancedSearch = function () {
        $scope.sidePanelOpen = true;
        $scope.selectedTimesheet = undefined;
        $scope.searching = true;
    };

    //Date Picker
    $scope.dateOptions = {'starting-day': 1};
    $scope.openDatepicker = function (eventz) {
        $scope.isOpen.datepicker = true;
    };
    
    //Delete an item / set isActive to 0
    $scope.deleteItem = function(item){
        item.isActive = 0;
        timesheetSrv.saveItem(item, formToken).then(function(){
            getTimesheetList();
        });
    };
    
    //Laborer Typeahead
    $scope.fetchLaborerAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.name = viewVal;
        return timesheetSrv.fetchLaborerAutocomplete(searchObject);
    };
    
    //Laborer Typeahead
    $scope.setAdvancedSearchLaborer = function (laborer) {
        $scope.advSearch.name = laborer.firstname + ' ' + laborer.lastname;
    };
});
