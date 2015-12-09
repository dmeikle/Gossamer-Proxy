module.service('documentSrv', function(crudSrv, $rootScope) {
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
});