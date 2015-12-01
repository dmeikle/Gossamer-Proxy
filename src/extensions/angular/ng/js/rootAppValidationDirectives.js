module.directive('formGroup', function() {
	return {
		restrict: 'C',
		controller: function($rootScope, validationSrv) {
			$rootScope.$on('showErrors', function() {
				for (var error in $rootScope.errors) {
					
				}
			});
		}
	};
});