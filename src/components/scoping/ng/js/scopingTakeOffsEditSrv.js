module.service('scopingTakeOffsEditSrv', function(crudSrv) {
	var self = this;
	var apiPath = '/admin/scoping/takeoffs/';

	this.getTakeoffDetails = function(claimsId, claimsLocationsId) {
		return crudSrv.getDetails(apiPath + 'get/' + claimsId, claimsLocationsId).then(function(response) {
                    self.takeOffDetails = response.data.TakeOff;
                    return response;
                });
	};
});