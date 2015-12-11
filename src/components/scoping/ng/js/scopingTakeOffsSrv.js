module.service('takeoffsEditSrv', function(crudSrv) {
	var self = this;
	var apiPath = '/admin/scoping/takeoffs/';

	this.getTakeoffDetails = function(id) {
		return crudSrv.getDetails(apiPath + 'save/', id);
	};
});