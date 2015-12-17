

module.controller('claimsEditModalCtrl', function($scope, $uibModalInstance, claim) {
    $scope.claim = claim;
    $scope.isOpen = {};
    $scope.openDatepicker = function (event) {
        var datepicker = event.target.parentElement.dataset.datepickername;
        $scope.isOpen[datepicker] = true;
    };

    $scope.submit = function() {
        var data = $scope.claim;
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        data.FORM_SECURITY_TOKEN = formToken;
        $uibModalInstance.close(data);
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };
});