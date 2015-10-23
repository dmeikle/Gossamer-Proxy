module.controller('contactsEditCtrl', function ($scope, $location, contactsEditSrv) {

    // Run on load
    $scope.loading = true;
    $scope.authorizationLoading = true;
    $scope.authorization = {};
    $scope.isOpen = {};
    //getContactDetail();

    // datepicker stuffs
    $scope.dateOptions = {'starting-day': 1};
    $scope.openDatepicker = function (event) {
        var datepicker = event.target.parentElement.dataset.datepickername;
        $scope.isOpen[datepicker] = true;
    };

    function getContactDetail() {
        var object = {};
        object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);

        contactsEditSrv.getContactDetail(object).then(function () {
            $scope.contact = contactsEditSrv.contactsDetail;
            $scope.loading = false;
        });
    }

    $scope.save = function (object) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        object.id = object.contactsId;
        contactsEditSrv.save(object, formToken).then(function () {
            getContactDetail();
        });
    };

    $scope.discardChanges = function () {
        getContactDetail();
    };



    $scope.clearErrors = function () {
        $scope.credentialStatus = undefined;
    };
});