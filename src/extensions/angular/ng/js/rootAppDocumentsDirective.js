module.directive('documents', function(documentSrv){
    return {
        restrict:'E',
        scope:true,
        replace:false,
        link: function(scope, element, attrs) {
            scope.model = JSON.parse(attrs.model);
            scope.module = attrs.module;
            scope.modelType = attrs.modelType;
            scope.config = attrs.config;
            documentSrv.getDocuments(scope.config).then(function(response) {
                scope.documents = response.data.Documents;
            });
        },
        controller: function($scope, $uibModal) {
            $scope.openUploadDocumentsModal = function(model, template) {
                 var modalInstance = $uibModal.open({
                    templateUrl: template,
                    controller: 'uploadDocumentsModalCtrl',
                    size: 'lg',
                    resolve: {
                        model: function() {
                            return model;
                        }
                    }
                });
                modalInstance.result.then(function (result) {
                    //Refresh the document list if the result (documentUploaded) is true
//                    var config = {};
                    
                    
                    if(result === true) {
                        documentSrv.getDocuments($scope.config).then(function(response) {
                            $scope.documents = response.data.Documents;
                        });                        
                    }
                });
            };

            function retrieveUploadDocumentsModal(module, modelType, modelId) {
                if (!documentSrv.uploadModalTemplate) {
                    return documentSrv.getUploadDocumentModal(module, modelType, modelId)
                        .then(function(response) {
                            return response.data;
                        });
                } else {
                    return documentSrv.uploadModalTemplate;
                }
            }
        }
    };
});