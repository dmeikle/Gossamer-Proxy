module.controller('claimsContactsList', function ($scope, $rootScope, $uibModal, claimsEditSrv) {

    // Run on load
    $scope.loading = true;
    $scope.claimLoading = true;
    $scope.contacts = [];
    $scope.timeRemaining = {};

    $rootScope.$on('projectAddressLoaded', function() {
        $scope.projectAddress = claimsEditSrv.projectAddress;
    });

    $rootScope.$on('claimDetailsLoaded', function() {
        $scope.claim = claimsEditSrv.claimDetails;
        var phase = $scope.claim.phase;
        var now = new Date();
        $scope.startDate = new Date(phase.startDate);
        $scope.endDate = new Date(phase.scheduledEndDate);

        $scope.timeRemaining.past = $scope.endDate > now ? false : true;

        // Time solution taken from http://stackoverflow.com/a/13904120
        // get total seconds between the times
        var delta = Math.abs($scope.endDate - now) / 1000;

        // calculate (and subtract) whole days
        $scope.timeRemaining.days = Math.floor(delta / 86400);
        delta -= $scope.timeRemaining.days * 86400;

        // calculate (and subtract) whole hours
        $scope.timeRemaining.hours = Math.floor(delta / 3600) % 24;

        $scope.claimLoading = false;
    });

    listContactsByClaim();


    function listContactsByClaim() {
        var jobNumber;
        if (document.getElementById('Claim_jobNumberHidden') && 
        document.getElementById('Claim_jobNumberHidden').value) {
            jobNumber = document.getElementById('Claim_jobNumberHidden').value;
        } else if (document.getElementById('Claim_unassignedJobNumberHidden') &&
        document.getElementById('Claim_unassignedJobNumberHidden').value) {
            jobNumber = document.getElementById('Claim_unassignedJobNumberHidden').value;
        }

        claimsEditSrv.getContacts(jobNumber).then(function () {
                $scope.contacts = claimsEditSrv.contacts;
                $scope.loading = false;
            }); 
    }

    $scope.openClientModal = function(client) {
        var modalInstance = $uibModal.open({
            templateUrl: '/render/claims/clientModal',
            controller: 'clientModalCtrl',
            size: 'md',
            resolve: {
                contact: function() {
                    return client;
                },
                claimId: function() {
                    return document.getElementById('Claim_id').value;
                }
            }
        });

        modalInstance.result.then(function() {
            listContactsByClaim();
        });
    };


    $scope.hasContacts = function() {
        if($scope.contacts && $scope.contacts.length !== undefined) {
           return $scope.contacts.length > 0;
        }
        
        return false;
    };
    
    
});
