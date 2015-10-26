module.controller('suppliesCtrl', function ($scope, costCardItemTypeSrv, accountingTemplateSrv, suppliesSrv, $modal, tablesSrv) {
    // Stuff to run on controller load
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;
    $scope.loading = true;
    $scope.previouslyClickedObject = {};
    $scope.noSearchResults = false;

    $scope.basicSearch = {};
    $scope.advancedSearch = {};
    $scope.advSearch = {};
    $scope.isOpen = {};
    $scope.isOpen.datepicker = {};
    $scope.isOpen.datepicker.fromDate = false;
    $scope.isOpen.datepicker.toDate = false;
    $scope.basicSearch.query = '';
    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    // Load up the table service so we can watch it!
    $scope.tablesSrv = tablesSrv;
    $scope.$watch('tablesSrv.sortResult', function () {
        if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
            $scope.list = tablesSrv.sortResult.SuppliesUseds;
            $scope.loading = false;
        }
    });

    $scope.$watchGroup(['tablesSrv.grouped', 'tablesSrv.groupResult.SuppliesUseds'], function () {
        $scope.grouped = tablesSrv.grouped;
        if ($scope.grouped === true) {
            if (tablesSrv.groupResult && tablesSrv.groupResult.SuppliesUseds)
                $scope.list = tablesSrv.groupResult.SuppliesUseds;
            $scope.loading = false;
        } else if ($scope.grouped === false) {
            getList();
        }
    });

    function getList() {
        $scope.loading = true;
        $scope.noSearchResults = false;
        suppliesSrv.getList(row, numRows)
                .then(function () {
                    $scope.loading = false;
                    $scope.list = suppliesSrv.list;
                    $scope.totalItems = suppliesSrv.listRowCount;
                    if (suppliesSrv.error.showError === true) {
                        $scope.error.showError = true;
                    }
                });
    }

    $scope.$watch('basicSearch.query', function () {
        if ($scope.basicSearch.query.length === 0) {
            getList();
        }
    });

    $scope.$watch('currentPage + itemsPerPage', function () {
        $scope.loading = true;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;
        getList(row, numRows);
    });

    //Select Rows for breakdown view
    $scope.selectRow = function (clickedObject) {
        $scope.searching = false;
        if ($scope.previouslyClickedObject !== clickedObject) {
            $scope.previouslyClickedObject = clickedObject;
            $scope.sidePanelOpen = true;
            $scope.sidePanelLoading = true;
            suppliesSrv.getBreakdown(row, numRows, clickedObject.id)
                    .then(function () {
                        $scope.selectedRow = clickedObject;
                        $scope.rowBreakdown = suppliesSrv.breakdownItems;
                        $scope.sidePanelLoading = false;
                    });
        } else {
            $scope.previouslyClickedObject = '';
            $scope.sidePanelOpen = false;
            $scope.sidePanelLoading = false;
        }
    };

    $scope.closeSidePanel = function () {
        $scope.sidePanelOpen = false;
        $scope.isOpen.datepicker.fromDate = false;
        $scope.isOpen.datepicker.toDate = false;
        $scope.previouslyClickedObject = '';
    };

    //Search
    $scope.search = function (searchObject) {
        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            suppliesSrv.search(copiedObject).then(function () {
                $scope.list = suppliesSrv.searchResults;
                $scope.totalItems = suppliesSrv.searchResultsCount;
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
        suppliesSrv.advancedSearch(searchObject).then(function () {
            $scope.list = suppliesSrv.advancedSearchResults;
            $scope.totalItems = suppliesSrv.advancedSearchResultsCount;
            if ($scope.totalItems === 0) {
                $scope.noSearchResults = true;
            }
            $scope.loading = false;
        });
    };

    $scope.resetSearch = function () {
        $scope.searchSubmitted = false;
        $scope.noSearchResults = false;
        $scope.basicSearch.query = '';
        getList();
    };

    $scope.autoSearch = function (searchString) {
        if (searchString.length >= 3) {
            $scope.search(searchString);
        }
    };

    $scope.resetAdvancedSearch = function () {
        $scope.searchSubmitted = false;
        $scope.advSearch = {};
        getList();
    };

    $scope.openAdvancedSearch = function () {
        $scope.sidePanelOpen = true;
        $scope.selectedTimesheet = undefined;
        $scope.searching = true;
        $scope.previouslyClickedObject = '';
    };

    //Date Picker
    $scope.dateOptions = {'starting-day': 1};

    $scope.openDatepicker = function (event, datepicker) {
        $scope.isOpen.datepicker[datepicker] = true;
    };

    //Modal
    $scope.openModal = function (item) {
        $scope.modalLoading = true;
        var template = accountingTemplateSrv.suppliesModal;
        var modal = $modal.open({
            templateUrl: template,
            controller: 'suppliesModalCtrl',
            size: 'lg',
            resolve: {
                suppliesUsed: function () {
                    return item;
                }
            }
        });
        modal.opened.then(function () {
            $scope.modalLoading = false;
        });
        modal.result.then(function () {
            getList();
        });
    };
});