module.directive('documents', function(documentSrv){
	return {
		restrict:'E',
		scope:true,
		replace:false,
		link: function(scope, element, attrs) {
			scope.model = JSON.parse(attrs.model);
			scope.module = attrs.module;
			scope.modelType = attrs.modelType;

			documentSrv.getDocuments(scope.model.id).then(function(response) {
				scope.documents = response.data;
			});
		},
		controller: function($scope, $uibModal) {
			$scope.openUploadDocumentsModal = function(model) {
				$uibModal.open({
                    template: retrieveUploadDocumentsModal($scope.module, $scope.modelType, $scope.model.id),
                    controller: 'uploadDocumentsModalCtrl',
                    size: 'lg',
                    resolve: {
                        model: function() {
                            return model;
                        }
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