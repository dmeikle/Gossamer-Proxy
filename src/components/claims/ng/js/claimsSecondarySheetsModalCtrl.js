module.controller('secondarySheetsModalCtrl', function($scope, $uibModalInstance) {
	

	$scope.close = function() {
		$uibModalInstance.dismiss();
	};
});