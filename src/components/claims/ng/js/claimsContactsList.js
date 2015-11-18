module.controller('claimsContactsList', function ($scope, $rootScope, claimsEditSrv) {

    // Run on load
    $scope.loading = true;
    $scope.contacts = [];
    $scope.timeRemaining = {};

    $rootScope.$on('projectAddressLoaded', function() {
        $scope.projectAddress = claimsEditSrv.projectAddress;
    });

    $rootScope.$on('claimDetailsLoaded', function() {
        $scope.claim = claimsEditSrv.claimDetails;
        var phase = $scope.claim.phase;
        var now = new Date();
        var startDate = new Date(phase.startDate);
        $scope.startDate = startDate.getUTCDate();
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
    });

    listContactsByClaim();


    function listContactsByClaim() {
        var jobNumber = document.getElementById('Claim_jobNumberHidden').value;

        claimsEditSrv.getContacts(jobNumber).then(function () {
            $scope.contacts = claimsEditSrv.contacts;
            $scope.loading = false;
        });
    }

});
