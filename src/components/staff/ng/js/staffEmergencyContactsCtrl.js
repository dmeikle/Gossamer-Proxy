module.controller('staffEmergencyContactsCtrl', function ($scope, $location, $modal, staffEmergencyContactsSrv, staffTemplateSrv) {
    $scope.loading = true;
    getStaffEmergencyInfo();

    function getStaffEmergencyInfo() {
        var object = {};
        object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);

        staffEmergencyContactsSrv.getStaffEmergencyInfo(object).then(function () {
            $scope.staffEmergencyContacts = staffEmergencyContactsSrv.staffEmergencyContacts;
            $scope.loading = false;
        });
    }

    $scope.openEditEmergencyContactModal = function (contact) {
        var template = staffTemplateSrv.editEmergencyContactModal;
        var modalInstance = $modal.open({
            templateUrl: template,
            controller: 'staffEmergencyContactModalCtrl',
            size: 'md',
            resolve: {
                contact: function () {
                    return contact;
                }
            }
        });

        modalInstance.result.then(function (contact) {
            var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
            contact.staffId = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);
            $scope.loading = true;
            staffEmergencyContactsSrv.save(contact, formToken).then(function () {
                getStaffEmergencyInfo();
            });
        });
    };

    $scope.delete = function (contact) {
        var confirmed = confirm('Are you sure you want to delete ' + contact.firstname + ' ' + contact.lastname + '?');
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;

        if (confirmed) {
            staffEmergencyContactsSrv.delete(contact, formToken).then(function () {
                getStaffEmergencyInfo();
            });
        }
    };
});

module.controller('staffEmergencyContactModalCtrl', function ($scope, $location, $modalInstance, contact) {
    if (contact) {
        $scope.contact = contact;
    } else {
        $scope.contact = {};
    }

    $scope.confirm = function () {
        $modalInstance.close($scope.contact);
    };

    $scope.close = function () {
        $modalInstance.dismiss('close');
    };
});
