

module.controller('staffModalCtrl', function($uibModalInstance, $scope, staffEditSrv) {
    $scope.staff = {};

    $scope.confirm = function() {

        staffEditSrv.save($scope.staff).then(function(response) {
            if (!response.data.result || response.data.result !== 'error') {
                $uibModalInstance.close();
            }
        });
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };
});