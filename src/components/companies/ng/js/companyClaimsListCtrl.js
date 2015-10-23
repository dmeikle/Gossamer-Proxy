module.controller('companyClaimsListCtrl', function ($scope, $modal, companyClaimsListSrv, companyTemplateSrv) {

    // Stuff to run on controller load
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;

    $scope.basicSearch = {};
    $scope.advancedSearch = {};
    $scope.autocomplete = {};

    $scope.previouslyClickedObject = {};

    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    var apiPath = '/admin/companies/claims/';

    function getClaimsList() {
        $scope.loading = true;
        companyClaimsListSrv.getClaimsList(row, numRows).then(function (response) {
            $scope.claimsList = companyClaimsListSrv.claimsList;
            $scope.totalItems = companyClaimsListSrv.claimsCount;
        }).then(function () {
            $scope.loading = false;
        });
    }



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
            companyClientsListSrv.getCompanyClientsList(clickedObject.Companies_id, 0, 100)
                    .then(function () {
                        $scope.selectedCompany = clickedObject;
                        $scope.clientsList = companyClientsListSrv.companyClientsList;
                        $scope.sidePanelLoading = false;
                    });
        }
    };

    $scope.$watch('currentPage + numPerPage', function () {
        $scope.loading = true;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;

        getCompanyList(row, numRows);
    });
});

module.controller('companyModalCtrl', function ($modalInstance, $scope) {
    $scope.company = {};

    $scope.confirm = function () {
        $modalInstance.close($scope.company);
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
});
