module.directive('documents', function(documentSrv){
	return {
		restrict:'E',
		scope:true,
		replace:false,
		link: function(scope, element, attrs) {
			scope.model = JSON.parse(attrs.model);

			retrieveUploadDocumentsModal(attrs.module, attrs.modelType, scope.model.id);

			documentSrv.getDocuments(scope.model.id).then(function(response) {
				scope.documents = response.data;
			});

			function retrieveUploadDocumentsModal(module, modelType, modelId) {
				documentSrv.getUploadDocumentModal(module, modelType, modelId)
					.then(function(response) {
						scope.uploadModal = response.data;
						documentSrv.templateLoaded();
					});
			}
		},
		controller: function($scope, $uibModal) {
			$scope.openUploadDocumentsModal = function(model) {
				$uibModal.open({
                    template: $scope.uploadModal,
                    controller: 'uploadDocumentsModalCtrl',
                    size: 'lg',
                    resolve: {
                        model: function() {
                            return model;
                        }
                    }
                });
			};
		}
	};
});