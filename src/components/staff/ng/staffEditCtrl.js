module.controller('staffEditCtrl', function ($scope, $location, staffEditSrv, staffPhotoSrv) {

    // Run on load
    $scope.loading = true;
    $scope.authorizationLoading = true;
    $scope.authorization = {};
    $scope.isOpen = {};
    getStaffDetail();

    // Load staffPhotoSrv so we can watch it
    $scope.staffPhotoSrv = staffPhotoSrv;
    $scope.$watch('staffPhotoSrv.photo', function () {
        if ($scope.staffPhotoSrv.photo !== undefined && $scope.staff.imageName !== undefined) {
            $scope.staff.imageName = $scope.staffPhotoSrv.photo;
        }
    });

    // datepicker stuffs
    $scope.dateOptions = {'starting-day': 1};
    $scope.openDatepicker = function (event) {
        var datepicker = event.target.parentElement.dataset.datepickername;
        $scope.isOpen[datepicker] = true;
    };

    function getStaffDetail() {
        var object = {};
        object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);

        staffEditSrv.getStaffDetail(object).then(function () {
            $scope.staff = staffEditSrv.staffDetail;
            $scope.loading = false;

            staffEditSrv.getStaffCreds(object).then(function () {
                $scope.authorization.username = staffEditSrv.staffCreds.username;
                $scope.authorizationLoading = false;
            });
        });
    }

    $scope.save = function (object) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        staffEditSrv.save(object, formToken).then(function () {
            if ($location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length) === '0') {
                window.location.pathname = '/admin/staff/edit/' + staffEditSrv.staffDetail.id;
            }
            getStaffDetail();
        });
    };

    $scope.discardChanges = function () {
        getStaffDetail();
    };

    $scope.submitCredentials = function (object) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        object.id = $scope.staff.id;
        switch (object.emailUser) {
            case true:
                staffEditSrv.generateEmailReset(object, formToken);
                break;
            default:
                staffEditSrv.saveCredentials(object, formToken).then(function () {
                    $scope.credentialStatus = staffEditSrv.credentialStatus;
                });
        }
    };

    $scope.resetCredentials = function () {
        $scope.authorization.username = staffEditSrv.staffCreds.username;
        $scope.authorization.password = undefined;
        $scope.authorization.passwordConfirm = undefined;
    };

    $scope.clearErrors = function () {
        $scope.credentialStatus = undefined;
    };
});
