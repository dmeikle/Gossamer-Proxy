module.controller('projectAddressesModalCtrl', function ($modalInstance, $scope, projectAddressesEditSrv, $filter) {
    $scope.basicSearch = {};
    $scope.autocomplete = {};

    //Modal Controls
    $scope.confirm = function () {
        $modalInstance.close();
        //$modalInstance.close($scope.staff);
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

    $scope.save = function (object) {

        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;

        projectAddressesEditSrv.save(object, formToken);
        $modalInstance.close();
    };


});
