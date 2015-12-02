module.controller('companyClientsListCtrl', function ($scope, $uibModal, companyClientsListSrv, companyClientsTemplateSrv) {

    // Stuff to run on controller load
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;

    $scope.basicSearch = {};
    $scope.advancedSearch = {};
    $scope.autocomplete = {};

    $scope.previouslyClickedObject = {};

    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    var apiPath = '/admin/companies/clients/';

    getCompanyClientsList();

    function getCompanyClientsList() {
        $scope.loading = true;

        var companyId = document.getElementById('Company_companyId').value;
        companyClientsListSrv.getCompanyClientsList(companyId, row, numRows).then(function (response) {
            $scope.companyClientsList = companyClientsListSrv.companyList;
            $scope.totalItems = companyClientsListSrv.companyCount;
        }).then(function () {
            $scope.loading = false;
        });
    }

    $scope.openAddNewModal = function () {
        var template = companyClientsTemplateSrv.AddNewModal;
        var modalInstance = $uibModal.open({
            templateUrl: template,
            controller: 'companyModalCtrl',
            size: 'xl'
        });

        modalInstance.result.then(function (company) {
            companyEditSrv.save(company).then(function () {
                getCompanyClientsList();
            });
        });
    };


    $scope.openCompanyAdvancedSearch = function () {
        $scope.sidePanelOpen = true;
        $scope.selectedCompany = undefined;
        $scope.sidePanelLoading = true;
        companyClientsListSrv.getAdvancedSearchFilters().then(function () {
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
            companyClientsListSrv.search(searchObject).then(function () {
                $scope.companyList = companyClientsListSrv.searchResults;
                $scope.totalItems = companyClientsListSrv.searchResultsCount;
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
            companyClientsListSrv.getCompanyDetail(clickedObject)
                    .then(function () {
                        $scope.selectedCompany = companyClientsListSrv.companyDetail;
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

module.controller('companyModalCtrl', function ($uibModalInstance, $scope) {
    $scope.company = {};

    $scope.confirm = function () {
        $uibModalInstance.close($scope.company);
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
});
