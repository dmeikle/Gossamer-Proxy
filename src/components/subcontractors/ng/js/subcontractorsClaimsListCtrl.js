module.controller('subcontractorsClaimsListCtrl', function ($scope, $uibModal, $location, subcontractorsClaimsListSrv, subcontractorsTemplateSrv) {

    // Stuff to run on controller load
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;

    $scope.basicSearch = {};
    $scope.advancedSearch = {};
    $scope.autocomplete = {};

    $scope.previouslyClickedObject = {};

   // getClaimsList();

    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    var apiPath = '/admin/subcontractors/claims/';

    function getClaimsList() {
        $scope.loading = true;
        var subcontractorsId = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);
        subcontractorsClaimsListSrv.getClaimsList(subcontractorsId, row, numRows).then(function (response) {
            $scope.claimsList = subcontractorsClaimsListSrv.claimsList;
            $scope.totalItems = subcontractorsClaimsListSrv.claimsCount;
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
            subcontractorsClientsListSrv.getCompanyClientsList(clickedObject.Companies_id, 0, 100)
                    .then(function () {
                        $scope.selectedCompany = clickedObject;
                        $scope.clientsList = subcontractorsClientsListSrv.subcontractorsClientsList;
                        $scope.sidePanelLoading = false;
                    });
        }
    };

    $scope.$watch('currentPage + numPerPage', function () {
        $scope.loading = true;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;

        getClaimsList(row, numRows);
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
