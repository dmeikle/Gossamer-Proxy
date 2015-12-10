module.controller('uploadDocumentsModalCtrl', function($scope, $rootScope, $uibModalInstance, 
    model, documentSrv, toastsSrv) {
	$scope.model = model;
	$scope.filesCount = documentSrv.getFileCount(model.id);
    $scope.hasError = {};

	$scope.dropzoneConfig = {
            'options': {
                'url': '/admin/documents/upload/' + $scope.model.id,
                'uploadMultiple': true,
                'dictDefaultMessage': '',
                'autoQueue': false
            },
            'eventHandlers': {
                'addedfile': function(file) {
                    $scope.hasError = {};
                    if (!$scope.upload || !$scope.upload.type) {
                        this.removeFile(file);
                        $scope.hasError.type = true;
                        var error = {};
                        error.data = { DocumentType : { 
                                type: 'Please select a document type'
                            },
                            result: 'error'
                        };

                        toastsSrv.newAlert(error);
                    } else {
                        $scope.hasError = {};
                        this.uploadFile(file);
                        this.processQueue();
                    }
                },
                'sending': function(file, xhr, formData) {
                    for (var property in $scope.upload) {
                        formData.append(property, $scope.upload[property]);
                    }
                }
            }
        };


    $rootScope.$on('documentCountUpdated', function(event, response) {
    	if (response.data.documentCount) {
	        $scope.documentCount = response.data.documentCount;
		}
    });

    // TODO: FIXME! don't use ClaimsDocumentsCount
    $rootScope.$on('documentUploaded', function(event, response) {
        documentSrv.getFileCount(documentSrv.id);
        $scope.documentCount = response.documentCount.ClaimDocumentsCount[0].rowCount;
    });

    $scope.clearErrors = function() {
        $scope.hasError = {};
    };

    $scope.close = function() {
        $uibModalInstance.dismiss('close');
    };
});