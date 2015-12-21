

module.controller('contactsModalCtrl', function ($uibModalInstance, $scope, contactsEditSrv) {
    $scope.contacts = {};

    $scope.confirm = function () {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;

        contactsEditSrv.save($scope.contact, formToken).then(function (response) {
            if (!response.data.result || response.data.result !== 'error') {
                $uibModalInstance.close();
            }
        });
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
});