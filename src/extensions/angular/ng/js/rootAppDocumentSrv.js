module.service('documentSrv', function(crudSrv) {
	var self = this;

	this.getDocuments = function(apiPath, id) {
		var config = {};
		config.Claims_id = id;
		return crudSrv.getList(apiPath, 0, 20, config);
	};
});