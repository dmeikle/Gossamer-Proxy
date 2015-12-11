module.controller('takeoffsEditCtrl', function($scope) {
	$scope.loading = true;

	$scope.claimId = document.getElementById('Claims_id').value;
	$scope.takeOff = getTakeoffDetails($scope.claimId);
	

	function getTakeoffDetails(claimId) {
		// body...
	}
});