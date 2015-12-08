module.directive('documents', function(documentSrv){
	return {
		restrict:'E',
		scope:true,
		replace:false,
		link: function(scope, element, attrs) {
			scope.model = JSON.parse(attrs.model);

			var apiPath = '/admin/documents/';

			scope.loading = true;

			documentSrv.getDocuments(apiPath, scope.model.id).then(function(response) {
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
                        }
                    }
                });
			};
		}
	};
});