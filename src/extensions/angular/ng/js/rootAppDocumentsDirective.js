module.directive('documents', function(documentSrv){
	return {
		restrict:'E',
		scope:true,
		replace:false,
		link: function(scope, element, attrs) {
			scope.model = JSON.parse(attrs.model);

			scope.loading = true;

			documentSrv.getDocuments(scope.model.id).then(function(response) {
				scope.documents = response.data;
			});
		},
		controller: function($scope, $uibModal) {
			$scope.openUploadDocumentsModal = function(model) {
				$uibModal.open({
                    templateUrl: '/render/claims/uploadDocumentModal',
                    controller: 'uploadDocumentsModalCtrl',
                    size: 'lg',
                    resolve: {
                        model: function() {
                            return model;
                        },
                        filesCount: function() {
                        	return documentSrv.getFileCount(model.id);
                        }
                    }
                });
			};
		}
	};
});