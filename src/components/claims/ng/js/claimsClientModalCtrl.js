
module.controller('clientModalCtrl', function($scope, $uibModalInstance, contact, claimId, claimsEditSrv, contactListSrv) {
    $scope.contact = contact;

    $scope.remove = function(object) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        claimsEditSrv.removeContact(object, formToken).then(function(response) {
            if (!response.data.result || response.data.result !== 'error') {
                $uibModalInstance.close();
            }
        });
    };

    function autocomplete(value, type) {
        return contactListSrv.autocomplete(value, type);
    }

    $scope.firstnameAutocomplete = function(viewValue) {
        return autocomplete(viewValue, 'name');
    };

    $scope.submit = function() {
        var data = $scope.contact;
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;

        contactListSrv.save(data, formToken, claimId).then(function(response) {
            if (!response.data.result || response.data.result !== 'error') {
                $uibModalInstance.close();
            }
        });
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };
});