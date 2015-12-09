module.controller('uploadDocumentsModalCtrl', function($scope, $rootScope, $uibModalInstance, model,
	documentSrv) {
	$scope.claim = model;
	$scope.filesCount = documentSrv.getFileCount(model.id);

	$scope.dropzoneConfig = {
        'options': {
            'url': '/admin/documents/upload/' + $scope.claim.id,
            'uploadMultiple': true,
            'dictDefaultMessage': ''
        },
        'eventHandlers': {
        	'sending': function(file, xhr, formData) {
        		for (var property in $scope.upload) {
        			formData.append(property, $scope.upload[property]);
        		}
        	},
            'success': function(file, response) {
	            $rootScope.$broadcast('documentUploaded', response);
	        }
        }
    };

    $rootScope.$on('documentCountUpdated', function(event, response) {
    	if (response.data.documentCount) {
	        $scope.documentCount = response.data.documentCount;
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