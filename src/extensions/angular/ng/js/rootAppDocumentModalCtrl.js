module.controller('uploadDocumentsModalCtrl', function($scope, $rootScope, $uibModalInstance, 
    model, documentSrv, toastsSrv, $log) {
	$scope.model = model;
	$scope.filesCount = documentSrv.getFileCount(model.id);
    $scope.hasError = {};
    $scope.documentCount = '77';
    
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
                $log.log('document uploaded successfully');
            }
        }
    };


    $rootScope.$on('documentCountUpdated', function(event, response) {
        $log.log('doc count updated!');
        $log.log(event);
        $log.log(response);
//        $scope.documentCount = '32';
//    	if (response.data && response.data.documentCount) {
//	        $scope.documentCount = response.data.documentCount;
//		} else {
//            $scope.documentCount = response.documentCount;
//        }
    });

    // TODO: FIXME! don't use ClaimsDocumentsCount
    $rootScope.$on('documentUploaded', function(event, response) {
        $log.log('uploaded event happened!');
//        $log.log(event);
        $log.log($scope);
//        $scope.documentCount = '54';
        if (response.data && response.data.documentCount) {
            $scope.documentCount = response.data.documentCount;
        } else {
            $log.log('update the document count!');
            $scope.documentCount = response.documentCount;
            $log.log($scope);
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