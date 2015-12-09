module.controller('uploadDocumentsModalCtrl', function($scope, $rootScope, $uibModalInstance, model, filesCount,
	documentSrv) {
	$scope.claim = model;
	$scope.filesCount = filesCount;

	$scope.dropzoneConfig = {
        'options': {
            'url': '/admin/documents/upload/' + $scope.claim.id,
            'uploadMultiple': true,
            'dictDefaultMessage': ''
        },
        'eventHandlers': {
            'success': function(file, response) {
	            $rootScope.$broadcast('documentUploaded', response);
	        }
        }
    };

    $rootScope.$on('documentCountUpdated', function(event, response) {
    	if (response.documentCount) {
	        $scope.documentCount = response.documentCount.ClaimDocumentsCount[0].rowCount;
		}
    });

    $rootScope.$on('documentUploaded', function(event, response) {
        documentSrv.getFileCount(documentSrv.id);
        $scope.documentCount = response.documentCount.ClaimDocumentsCount[0].rowCount;
    });

    $scope.close = function() {
        $uibModalInstance.dismiss('close');
    };
});