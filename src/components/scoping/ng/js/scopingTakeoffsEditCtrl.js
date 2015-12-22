module.controller('scopingTakeoffsEditCtrl', function($scope, scopingTakeOffsEditSrv) {
	$scope.loading = true;

	
	$scope.takeOff = getTakeoffDetails($scope.claimId);
	

	function getTakeoffDetails() {
            var claimId = document.getElementById('Claims_id').value;
            var claimsLocationsId = document.getElementById('ClaimsLocations_id').value;
            scopingTakeOffsEditSrv.getTakeoffDetails(claimId, claimsLocationsId).then(function () {
                $scope.takeoff = scopingTakeOffsEditSrv.takeOffDetails;
                $scope.loading = false;
            });
	}
});