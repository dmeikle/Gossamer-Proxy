module.controller('claimsEditCtrl', function ($scope, $rootScope, $uibModal, claimsEditSrv, claimsTemplateSrv) {

    // Run on load
    $scope.paLoading = true;
    $scope.claimLoading = true;
    $scope.authorizationLoading = true;
    $scope.templateLoading = true;
    $scope.authorization = {};
    $scope.isOpen = {};
    $scope.contacts = [];

    $scope.hasError = {};

    getProjectAddress();
    getClaimDetails();

    // datepicker stuffs
    $scope.dateOptions = {'starting-day': 1};
    $scope.openDatepicker = function (event) {
        var datepicker = event.target.parentElement.dataset.datepickername;
        $scope.isOpen[datepicker] = true;
    };

    function getClaimDetails() {

        $scope.claimId = document.getElementById('Claim_id').value;

        claimsEditSrv.getClaimDetails($scope.claimId).then(function() {
            $rootScope.$broadcast('claimDetailsLoaded');
            $scope.claim = claimsEditSrv.claimDetails;
            $scope.claimLoading = false;

        });
    }

    function getProjectAddress() {

        var addressId = document.getElementById('Claim_ProjectAddresses_id').value;

        claimsEditSrv.getProjectAddress(addressId).then(function() {
            $rootScope.$broadcast('projectAddressLoaded');
            $scope.projectAddress = claimsEditSrv.projectAddress;
            $scope.paLoading = false;
        });
    }

    $scope.getStatusColor = function(claim) {
        if (claim.phase.title == 'Cancelled') {
            return 'warning';
        } else if (claim.phase.title == 'Complete') {
            return 'success';
        } else {
            return 'danger';
        }
    };

    $scope.save = function(object) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        object.id = object.claimsId;
        claimsEditSrv.save(object, formToken).then(function() {
            getClaimDetails();
        });
    };

    $scope.discardChanges = function() {
        getClaimDetails();
    };

    $scope.openEditModal = function(claim) {
        $scope.modalLoading = true;
        var template = claimsTemplateSrv.claimEditModal;
        var modal = $uibModal.open({
            templateUrl: template,
            controller: 'claimsEditModalCtrl',
            size: 'xl',
            resolve: {
                claim: function() {
                    return claim;
                }
            }
        });
        modal.opened.then(function() {
            $scope.modalLoading = false;
        });
        modal.result.then(function() {
            claimsEditSrv.save(claim).then(function () {
                getClaimDetails();
            });
        });
    };
});
