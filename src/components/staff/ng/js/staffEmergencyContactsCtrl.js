//module.controller('staffEmergencyContactsCtrl', function ($scope, $location, $modal, staffEmergencyContactsSrv, staffTemplateSrv) {
//    $scope.loading = true;
//    getStaffEmergencyInfo();
//
//    function getStaffEmergencyInfo() {
//        $scope.loading = true;
//        var object = {};
//        object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);
//
//        staffEmergencyContactsSrv.getStaffEmergencyInfo(object).then(function () {
//            $scope.staffEmergencyContacts = staffEmergencyContactsSrv.staffEmergencyContacts;
//            $scope.loading = false;
//        });
//    }
//
//    $scope.openEditEmergencyContactModal = function (contact) {
//        var template = staffTemplateSrv.editEmergencyContactModal;
//        var modalInstance = $modal.open({
//            templateUrl: template,
//            controller: 'staffEmergencyContactModalCtrl',
//            size: 'md',
//            resolve: {
//                contact: function () {
//                    return contact;
//                }
//            }
//        });
//
//        modalInstance.result.then(function () {
//            getStaffEmergencyInfo();
//        });
//    };
//
//    $scope.delete = function (contact) {
//        var confirmed = confirm('Are you sure you want to delete ' + contact.firstname + ' ' + contact.lastname + '?');
//        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
//
//        if (confirmed) {
//            staffEmergencyContactsSrv.delete(contact, formToken).then(function () {
//                getStaffEmergencyInfo();
//            });
//        }
//    };
//});
//
//module.controller('staffEmergencyContactModalCtrl', function ($scope, $location, $modalInstance, contact) {
//    if (contact) {
//        $scope.contact = contact;
//    } else {
//        $scope.contact = {};
//    }
//
//    $scope.confirm = function () {
//
//        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
//        $scope.contact.staffId = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);
//        staffEmergencyContactsSrv.save($scope.contact, formToken).then(function (response) {
//            if (!response.data.result || response.data.result !== 'error') {
//                $modalInstance.close();
//            }
//        });
//    };
//
//    $scope.close = function () {
//        $modalInstance.dismiss('close');
//    };
//});


(function() {
    
    angular
        .module('staffAdmin')
        .controller('staffEmergencyContactsCtrl', staffEmergencyContactsCtrl);

    function staffEmergencyContactsCtrl($rootScope, $scope, $modal, staffEmergencyContactsSrv) {
        var self = this;
        self.loading = false;
        self.staffLoaded = false;
        
        $rootScope.$on('STAFF_LOADED', function(event, args) {
            self.loading = true;
            self.staffLoaded = true;
            loadEmergencyContacts(args.staff);
        });
        
        $scope.$on('CONTACT_SAVED', function(event, args) {
            self.loading = true;
            var staff = {};
            staff.id = document.getElementById('Staff_id').value;
            
            loadEmergencyContacts(staff);
        });
        
        $scope.$on('CONTACT_DELETED', function(event, args) {
            //need something here to remove from list
        });
        
        function loadEmergencyContacts(staff) {
            staffEmergencyContactsSrv.getStaffEmergencyInfo(staff).then(function(contactList) {
               self.staffEmergencyContacts = contactList;
               self.loading = false;
            });
        }
        
        
        self.openEditEmergencyContactModal = function (contact) {

            var modalInstance = $modal.open({
                templateUrl: 'emergencyContactInfo',
                controller: 'staffEmergencyContactModalCtrl as ctrl',
                size: 'md',
                resolve: {
                    contact: function () {
                        return contact;
                    }
                }
            });

            modalInstance.result.then(function () {
                $scope.$broadcast('CONTACT_SAVED', {contact: contact});
            });
        };
        
        self.delete = function (contact) {
            var confirmed = confirm('Are you sure you want to delete ' + contact.firstname + ' ' + contact.lastname + '?');
            var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;

            if (confirmed) {
                staffEmergencyContactsSrv.delete(contact, formToken).then(function () {
                    $scope.$broadcast('CONTACT_DELETED', {contact: contact});
                });
            }
        };
    }
})();