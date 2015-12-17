

module.controller('staffModalCtrl', function($modalInstance, $scope) {
    $scope.staff = {};

    $scope.confirm = function() {

        staffEditSrv.save($scope.staff).then(function(response) {
            if (!response.data.result || response.data.result !== 'error') {
                $modalInstance.close();
            }
        });
    };

    $scope.cancel = function() {
        $modalInstance.dismiss('cancel');
    };
});