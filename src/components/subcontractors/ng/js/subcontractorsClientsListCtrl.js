module.controller('subcontractorsClientsListCtrl', function ($scope, $modal, subcontractorsClientsListSrv, subcontractorsClientsTemplateSrv) {

    // Stuff to run on controller load
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;

    $scope.basicSearch = {};
    $scope.advancedSearch = {};
    $scope.autocomplete = {};

    $scope.previouslyClickedObject = {};

    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    var apiPath = '/admin/subcontractors/clients/';

    getCompanyClientsList();

    function getCompanyClientsList() {
        $scope.loading = true;

        var subcontractorsId = document.getElementById('Company_subcontractorsId').value;
        subcontractorsClientsListSrv.getCompanyClientsList(subcontractorsId, row, numRows).then(function (response) {
            $scope.subcontractorsClientsList = subcontractorsClientsListSrv.subcontractorsList;
            $scope.totalItems = subcontractorsClientsListSrv.subcontractorsCount;
        }).then(function () {
            $scope.loading = false;
        });
    }

    $scope.openAddNewModal = function () {
        var template = subcontractorsClientsTemplateSrv.AddNewModal;
        var modalInstance = $modal.open({
            templateUrl: template,
            controller: 'subcontractorsModalCtrl',
            size: 'xl'
        });

        modalInstance.result.then(function (subcontractors) {
            subcontractorsEditSrv.save(subcontractors).then(function () {
                getCompanyClientsList();
            });
        });
    };


    $scope.openCompanyAdvancedSearch = function () {
        $scope.sidePanelOpen = true;
        $scope.selectedCompany = undefined;
        $scope.sidePanelLoading = true;
        subcontractorsClientsListSrv.getAdvancedSearchFilters().then(function () {
            $scope.sidePanelLoading = false;
            $scope.searching = true;
        });
    };

    $scope.resetAdvancedSearch = function () {
        $scope.advancedSearch.query = {};
        getCompanyClientsList();
    };

    $scope.search = function (searchObject) {
        if (searchObject && Object.keys(searchObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            subcontractorsClientsListSrv.search(searchObject).then(function () {
                $scope.subcontractorsList = subcontractorsClientsListSrv.searchResults;
                $scope.totalItems = subcontractorsClientsListSrv.searchResultsCount;
                $scope.loading = false;
            });
        }
    };

    $scope.resetSearch = function () {
        $scope.searchSubmitted = false;
        $scope.basicSearch.query = {};
        getCompanyClientsList();
    };

    $scope.closeSidePanel = function () {
        if ($scope.searching) {
            $scope.searching = false;
        }
        if ($scope.selectedCompany) {
            $scope.selectedCompany = undefined;
            $scope.previouslyClickedObject = undefined;
        }
        if (!$scope.selectedCompany && !$scope.searching) {
            $scope.sidePanelOpen = false;
        }
    };

    $scope.selectRow = function (clickedObject) {

        $scope.searching = false;
        $scope.sidePanelLoading = true;
        $scope.sidePanelOpen = true;
        if ($scope.previouslyClickedObject !== clickedObject) {
            $scope.previouslyClickedObject = clickedObject;
            subcontractorsClientsListSrv.getCompanyDetail(clickedObject)
                    .then(function () {
                        $scope.selectedCompany = subcontractorsClientsListSrv.subcontractorsDetail;
                        $scope.sidePanelLoading = false;
                    });
        }
    };

    $scope.$watch('currentPage + numPerPage', function () {
        $scope.loading = true;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;

        getCompanyClientsList(row, numRows);
    });
});

module.controller('subcontractorsModalCtrl', function ($modalInstance, $scope) {
    $scope.subcontractors = {};

    $scope.confirm = function () {
        $modalInstance.close($scope.subcontractors);
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
});
