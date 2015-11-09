module.controller('subcontractorsEditCtrl', function ($scope, $location, subcontractorsEditSrv) {

    // Run on load
    $scope.loading = true;
    $scope.authorizationLoading = true;
    $scope.authorization = {};
    $scope.isOpen = {};
    //getCompanyDetail();

    // datepicker stuffs
    $scope.dateOptions = {'starting-day': 1};
    $scope.openDatepicker = function (event) {
        var datepicker = event.target.parentElement.dataset.datepickername;
        $scope.isOpen[datepicker] = true;
    };

    function getCompanyDetail() {
        var object = {};
        object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);

        subcontractorsEditSrv.getCompanyDetail(object).then(function () {
            $scope.subcontractors = subcontractorsEditSrv.subcontractorsDetail;
            $scope.loading = false;
        });
    }

    $scope.save = function (object) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        object.id = object.subcontractorsId;
        subcontractorsEditSrv.save(object, formToken).then(function () {
            getCompanyDetail();
        });
    };

    $scope.discardChanges = function () {
        getCompanyDetail();
    };



    $scope.clearErrors = function () {
        $scope.credentialStatus = undefined;
    };
});
