module.controller('uploadDocumentsModalCtrl', function($scope, $rootScope, $uibModalInstance, 
    model, documentSrv, toastsSrv, $log) {
	$scope.model = model;
	$scope.filesCount = documentSrv.getFileCount(model.id);
    $scope.hasError = {};
    $scope.documentUploading = false;
    
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
                if (!$scope.upload || !$scope.upload.DocumentTypes_id) {
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
                    $scope.documentUploading = true;
                    $scope.$digest();
                    this.uploadFile(file);
                    this.processQueue();
                }
            },
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
    	if (response.data && response.data.documentCount) {
            $scope.documentCount = response.data.documentCount;
        } else {
            $scope.documentCount = response.documentCount;
        }
    });

    // TODO: FIXME! don't use ClaimsDocumentsCount
    $rootScope.$on('documentUploaded', function(event, response) {
        $scope.documentUploading = false;
        if (response.data && response.data.documentCount) {
            $scope.documentCount = response.data.documentCount;
            $scope.$digest();
        } else {
            $scope.documentCount = response.documentCount;
            $scope.$digest();
        }
    });

    $scope.clearErrors = function() {
        $scope.hasError = {};
    };

    $scope.close = function() {
        $uibModalInstance.dismiss('close');
    };
});