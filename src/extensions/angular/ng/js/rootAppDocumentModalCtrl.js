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
            'success': function() {
	            $rootScope.$broadcast('documentUploaded');
	        }
        }
    };

    $rootScope.$on('documentCountUpdated', function(event, response) {
        $scope.fileCount = response.data.folderList.list;
    });

    $rootScope.$on('documentUploaded', function(event, response) {
        documentSrv.getFileCount(event, documentSrv.id);
    });

    $scope.close = function() {
        $uibModalInstance.dismiss('close');
    };
});