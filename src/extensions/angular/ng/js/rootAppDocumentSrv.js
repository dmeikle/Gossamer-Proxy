module.service('documentSrv', function(crudSrv, $http, $rootScope) {
	var self = this;
	var apiPath = '/admin/documents/';

	this.getDocuments = function(id) {
		var config = {};
		config.Claims_id = id;
		return crudSrv.getList(apiPath, 0, 20, config);
	};

	this.getFileCount = function(id) {
		this.id = id;
		return crudSrv.getDetails(apiPath + 'count/', id).then(function(response) {
    		$rootScope.$broadcast('documentCountUpdated', response);
    		return response;
    	});
	};

	this.templateLoaded = function() {
		$rootScope.$broadcast('templateLoaded');
	};

	this.getUploadDocumentModal = function(module, modelType, modelId) {
		var config = {};
		config[modelType+'s_id'] = modelId;
		return $http({
			method: 'GET',
			url: '/render/' + module + '/uploadDocumentModal',
			params: config,
		}).then(function(response) {
			self.uploadModalTemplate = response.data;
			return response;
		});
	};
});