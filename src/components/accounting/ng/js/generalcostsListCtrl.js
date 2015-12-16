module.controller('generalCostsListCtrl', function ($scope, costCardItemTypeSrv, accountingTemplateSrv, generalCostsSrv, $modal, tablesSrv) {
    // Stuff to run on controller load
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;
    $scope.loading = true;
    $scope.previouslyClickedObject = {};
    $scope.noSearchResults = false;

    $scope.basicSearch = {};
    $scope.advancedSearch = {};
    $scope.advSearch = {};
    $scope.autocomplete = {};
    $scope.isOpen = {};
    $scope.isOpen.datepicker = {};
    $scope.isOpen.datepicker.fromDate = false;
    $scope.isOpen.datepicker.toDate = false;


    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    
    // Load up the table service so we can watch it!
    $scope.tablesSrv = tablesSrv;
    
    $scope.$watch('tablesSrv.sortResult', function () {
        if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
            $scope.list = tablesSrv.sortResult.AccountingGeneralCosts;
            $scope.loading = false;
        }
    });

    $scope.$watchGroup(['tablesSrv.grouped', 'tablesSrv.groupResult.AccountingGeneralCosts'], function () {
        $scope.grouped = tablesSrv.grouped;
        if ($scope.grouped === true) {
            if (tablesSrv.groupResult && tablesSrv.groupResult.AccountingGeneralCosts)
                $scope.generalCostsList = tablesSrv.groupResult.AccountingGeneralCosts;
            $scope.loading = false;
        } else if ($scope.grouped === false) {
            getGeneralCostsList();
        }
    });

    
    function getGeneralCostsList() {
        $scope.loading = true;
        $scope.noSearchResults = false;

        generalCostsSrv.getGeneralCostsList(row, numRows)
                .then(function () {
                    $scope.loading = false;
                    $scope.generalCostsList = generalCostsSrv.generalCostsList;
                    $scope.totalItems = generalCostsSrv.generalCostsCount;
                    if (generalCostsSrv.error.showError === true) {
                        $scope.error.showError = true;
                        //$scope.error.message = 'Could not reach the database, please try again.';
                    }
                });
    }

    $scope.$watch('currentPage + itemsPerPage', function () {
        $scope.loading = true;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;
        getGeneralCostsList(row, numRows);
    });

    //Select Rows for breakdown view
    $scope.selectRow = function (clickedObject) {
        $scope.searching = false;
        if ($scope.previouslyClickedObject !== clickedObject) {
            $scope.previouslyClickedObject = clickedObject;
            $scope.sidePanelOpen = true;
            $scope.sidePanelLoading = true;
            generalCostsSrv.getGeneralCostItems(row, numRows, clickedObject.id)
                    .then(function () {
                        //                    $scope.sidePanelOpen = true;
                        $scope.selectedRow = clickedObject;
                        $scope.rowBreakdown = generalCostsSrv.generalCostItems;
                        $scope.sidePanelLoading = false;
                    });
        }
    };

    $scope.closeSidePanel = function () {
        $scope.sidePanelOpen = false;
        $scope.isOpen.datepicker.fromDate = false;
        $scope.isOpen.datepicker.toDate = false;
    };

    //Search
    $scope.search = function (searchObject) {
        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            generalCostsSrv.search(copiedObject).then(function () {
                $scope.generalCostsList = generalCostsSrv.searchResults;
                $scope.totalItems = generalCostsSrv.searchResultsCount;
                $scope.loading = false;
            });
        }
    };

    $scope.advancedSearch = function (searchObject) {
        $scope.loading = true;
        $scope.noSearchResults = false;
        generalCostsSrv.advancedSearch(searchObject).then(function () {
            $scope.generalCostsList = generalCostsSrv.advancedSearchResults;
            $scope.totalItems = generalCostsSrv.advancedSearchResultsCount;
            if ($scope.totalItems === '0') {
                $scope.noSearchResults = true;
            }
            $scope.loading = false;
        });
    };

    $scope.resetSearch = function () {
        $scope.searchSubmitted = false;
        $scope.basicSearch.query = '';
        getGeneralCostsList();
    };

    $scope.autoSearch = function (searchString) {
        if (searchString.length >= 3) {
            $scope.search(searchString);
        }
    };

    $scope.resetAdvancedSearch = function () {
        $scope.searchSubmitted = false;
        $scope.advSearch = {};
        getGeneralCostsList();
    };

    $scope.openAdvancedSearch = function () {
        $scope.sidePanelOpen = true;
        $scope.selectedTimesheet = undefined;
        $scope.searching = true;
    };
    
    $scope.fetchClaimAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.jobNumber = viewVal;
        return generalCostsSrv.fetchClaimsAutocomplete(searchObject);
    };
    
    //Get JobNumber
    $scope.getJobNumber = function (claim) {
        $scope.advSearch.jobNumber = claim.jobNumber;
    };

    //Date Picker
    $scope.dateOptions = {'starting-day': 1};

    $scope.openDatepicker = function (event, datepicker) {
        $scope.isOpen.datepicker[datepicker] = true;
    };

    //Modal
    $scope.openGeneralCostsModal = function (generalCost) {
        $scope.modalLoading = true;
        var template = accountingTemplateSrv.generalCostsModal;
        var modal = $modal.open({
            templateUrl: template,
            controller: 'generalCostsModalCtrl',
            size: 'lg',
            resolve: {
                generalCost: function () {
                    return generalCost;
                }
            }
        });
        modal.opened.then(function () {
            $scope.modalLoading = false;
        });
        modal.result.then(function () {
            getGeneralCostsList();
        });
    };
    
    $scope.deleteItem = function(item){
//        var test = {};        
        item.isActive = 0;
//        test.id = item.id;
        generalCostsSrv.saveItem(item, formToken).then(function(){
            getGeneralCostsList();
        });
    };
});