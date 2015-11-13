module.controller('subcontractorsEditCtrl', function ($scope, $location, subcontractorsEditSrv) {

    // Run on load
    $scope.loading = true;
    $scope.authorizationLoading = true;
    $scope.authorization = {};
    $scope.isOpen = {};
    $scope.subcontractor = {};
    
    getSubcontractorDetail();

    // datepicker stuffs
    $scope.dateOptions = {'starting-day': 1};
    $scope.openDatepicker = function (event) {
        var datepicker = event.target.parentElement.dataset.datepickername;
        $scope.isOpen[datepicker] = true;
    };

    function getSubcontractorDetail() {
        var object = {};
        object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);
        //object.id = document.getElementById('Subcontractor_id').value;
        
        subcontractorsEditSrv.getSubcontractorDetail(object).then(function () {
            $scope.subcontractor = subcontractorsEditSrv.subcontractorDetail;
            $scope.loading = false;
        });
    }

    $scope.save = function (object) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        if(object.id === undefined) {
            object.id = object.subcontractorsId;
        }
        subcontractorsEditSrv.save(object, formToken).then(function () {
            getSubcontractorDetail();
        });
    };

    $scope.discardChanges = function () {
        getSubcontractorDetail();
    };



    $scope.clearErrors = function () {
        $scope.credentialStatus = undefined;
    };
});
