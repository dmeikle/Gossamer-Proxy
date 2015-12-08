module.controller('uploadDocumentsModalCtrl', function($scope, $rootScope, model) {
	$scope.claim = model;

	$scope.dropzoneConfig = {
            'options': {
                'url': '/admin/documents/upload/' + $scope.claim.id,
                'uploadMultiple': true,
                'dictDefaultMessage': ''
            },
            'eventHandlers': {
                'success': function() {
		            $rootScope.$broadcast('documentUploaded');
		        }
            }
        };
});