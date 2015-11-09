module.controller('subcontractorsListCtrl', function ($scope, $uibModal, subcontractorsListSrv, subcontractorsClaimsListSrv, subcontractorsEditSrv, subcontractorsTemplateSrv) {

    // Stuff to run on controller load
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;

    $scope.basicSearch = {};
    $scope.advancedSearch = {};
    $scope.autocomplete = {};

    $scope.previouslyClickedObject = {};

    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    var apiPath = '/admin/subcontractors/';

    function getSubcontractorList() {
        $scope.loading = true;
        subcontractorsListSrv.getSubcontractorList(row, numRows).then(function (response) {
            $scope.subcontractorsList = subcontractorsListSrv.subcontractorsList;
            $scope.totalItems = subcontractorsListSrv.subcontractorsCount;
        }).then(function () {
            $scope.loading = false;
        });
    }

    $scope.openAddNewSubcontractorModal = function (item) {
        var template = subcontractorsTemplateSrv.AddNewModal;
        var modalInstance = $uibModal.open({
            templateUrl: template,
            controller: 'subcontractorsModalCtrl',
            size: 'xl'
        });

        modalInstance.result.then(function (subcontractors) {
            subcontractorsEditSrv.save(subcontractors).then(function () {
                getSubcontractorList();
            });
        });
    };


    $scope.openSubcontractorAdvancedSearch = function () {
        $scope.sidePanelOpen = true;
        $scope.selectedSubcontractor = undefined;
        $scope.sidePanelLoading = true;
        subcontractorsListSrv.getAdvancedSearchFilters().then(function () {
            $scope.sidePanelLoading = false;
            $scope.searching = true;
        });
    };

    $scope.resetAdvancedSearch = function () {
        $scope.advancedSearch.query = {};
        getSubcontractorList();
    };

    $scope.search = function (searchObject) {
        if (searchObject && Object.keys(searchObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            subcontractorsListSrv.search(searchObject).then(function () {
                $scope.subcontractorsList = subcontractorsListSrv.searchResults;
                $scope.totalItems = subcontractorsListSrv.searchResultsCount;
                $scope.loading = false;
            });
        }
    };

    $scope.resetSearch = function () {
        $scope.searchSubmitted = false;
        $scope.basicSearch.query = {};
        getSubcontractorList();
    };

    $scope.closeSidePanel = function () {
        if ($scope.searching) {
            $scope.searching = false;
        }
        if ($scope.selectedSubcontractor) {
            $scope.selectedSubcontractor = undefined;
            $scope.previouslyClickedObject = undefined;
        }
        if (!$scope.selectedSubcontractor && !$scope.searching) {
            $scope.sidePanelOpen = false;
        }
    };

    $scope.selectRow = function (clickedObject) {

        $scope.searching = false;
        $scope.sidePanelLoading = true;
        $scope.sidePanelOpen = true;
        if ($scope.previouslyClickedObject !== clickedObject) {
            $scope.previouslyClickedObject = clickedObject;
            subcontractorsClaimsListSrv.getClaimsList(clickedObject.Companies_id, 0, 100)
                    .then(function () {
                        $scope.selectedSubcontractor = clickedObject;
                        $scope.claimsList = subcontractorsClaimsListSrv.claimsList;
                        $scope.sidePanelLoading = false;
                    });
        }
    };

    $scope.$watch('currentPage + numPerPage', function () {
        $scope.loading = true;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;

        getSubcontractorList(row, numRows);
    });
});

module.controller('subcontractorsModalCtrl', function ($uibModalInstance, $scope) {
    $scope.subcontractors = {};

    $scope.confirm = function () {
        $uibModalInstance.close($scope.subcontractors);
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
});
