
module.controller('projectAddressesListCtrl', function ($scope, $modal, projectAddressesListSrv, projectAddressesEditSrv, projectAddressesTemplateSrv, tablesSrv, toastsSrv) {

    $scope.newAlert = toastsSrv.newAlert;
    // Stuff to run on controller load
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;

    $scope.basicSearch = {};
    $scope.advancedSearch = {};
    $scope.autocomplete = {};

    $scope.previouslyClickedObject = {};

    // Load up the table service so we can watch it!
    $scope.tablesSrv = tablesSrv;
    $scope.$watch('tablesSrv.sortResult', function () {
        if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
            $scope.projectAddressesList = tablesSrv.sortResult.ProjectAddresss;
            $scope.loading = false;
        }
    });

    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    var apiPath = '/admin/projects/';

    $scope.setItemsPerPage = function (number) {
        $scope.itemsPerPage = number;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;
        getProjectAddressList();
    };

    function getList() {
        $scope.loading = true;
        projectAddressesListSrv.getList(row, numRows).then(function (response) {
            $scope.projectAddressesList = projectAddressesListSrv.projectAddressesList;
            $scope.totalItems = projectAddressesListSrv.projectAddressesCount;
        }).then(function () {
            $scope.loading = false;
        });
    }

    $scope.fetchAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.name = viewVal;

        return projectAddressesListSrv.fetchAutocomplete(searchObject);
    };

    $scope.openNewBuildingModal = function () {
        var template = projectAddressesTemplateSrv.projectAddressesAddNewModal;
        var modalInstance = $modal.open({
            templateUrl: template,
            controller: 'projectAddressesModalCtrl',
            size: 'xl'
        });

        modalInstance.result.then(function () {
            getList();
        });
    };


    $scope.openAdvancedSearch = function () {
        $scope.sidePanelOpen = true;
        $scope.selectedProjectAddress = undefined;
        $scope.searching = true;
        //$scope.sidePanelLoading = true;
//        projectAddressesListSrv.getAdvancedSearchFilters().then(function () {
//            $scope.sidePanelLoading = false;
//            $scope.searching = true;
//        });
    };

    $scope.resetAdvancedSearch = function () {
        $scope.advancedSearch.query = {};
        getProjectAddressesList();
    };

    $scope.search = function (searchObject) {
        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            projectAddressesListSrv.search(copiedObject).then(function () {
                $scope.projectAddressesList = projectAddressesListSrv.searchResults;
                $scope.totalItems = projectAddressesListSrv.searchResultsCount;
                $scope.loading = false;
            });
        }
    };

    $scope.resetSearch = function () {
        $scope.searchSubmitted = false;
        $scope.basicSearch.query = {};
        getList();
    };

    $scope.closeSidePanel = function () {
        if ($scope.searching) {
            $scope.searching = false;
        }
        if ($scope.selectedProjectAddress) {
            $scope.selectedProjectAddress = undefined;
            $scope.previouslyClickedObject = undefined;
        }
        if (!$scope.selectedProjectAddress && !$scope.searching) {
            $scope.sidePanelOpen = false;
        }
    };

    $scope.selectRow = function (clickedObject) {
        $scope.searching = false;
        if ($scope.previouslyClickedObject !== clickedObject) {
            $scope.previouslyClickedObject = clickedObject;
            $scope.sidePanelLoading = true;
            projectAddressesListSrv.getProjectAddressDetail(clickedObject)
                    .then(function () {
                        $scope.selectedProjectAddress = projectAddressesListSrv.projectAddressDetail;
                        $scope.sidePanelOpen = true;
                        $scope.sidePanelLoading = false;
                    });
        }
    };
    $scope.$watch('currentPage + itemsPerPage', function () {
        $scope.loading = true;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;

        getList(row, numRows);
    });
});

module.controller('projectAddressModalCtrl', function ($modalInstance, $scope) {
    $scope.projectAddresses = {};

    $scope.confirm = function () {
        projectAddressesEditSrv.save($scope.projectAddresses).then(function (response) {
            if (!response.data.result || response.data.result !== 'error') {
                $modalInstance.close();
            }
        });
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
});
