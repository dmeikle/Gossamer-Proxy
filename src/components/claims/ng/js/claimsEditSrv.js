module.service('claimsEditSrv', function(crudSrv, searchSrv) {
    var objectType = 'Claim';
    var apiPath = '/admin/claims/';
    var singleApiPath = '/admin/claim/';
    var projectApiPath = '/admin/projects/';
    var claimLocationsApiPath = '/admin/claims/locations/';
    var removeApiPath = '/admin/claims/remove/';

    var self = this;



    this.save = function(object, formToken, page) {

        var requestPath;
        if (object.id && page) {
            requestPath = singleApiPath + page + '/' + object.id;
        } else if (!page) {
            requestPath = singleApiPath + object.id;
        } else {
            requestPath = singleApiPath + page + '/0';
        }
        var copiedObject = angular.copy(object);
        if (object.callInDate) {
            copiedObject.callInDate = object.callInDate.toISOString().substring(0, 10);
        }
        return crudSrv.save(requestPath, copiedObject, objectType, formToken);

    };


    this.getClaimDetails = function(id) {

        return crudSrv.getDetails(apiPath, id).then(function(response) {
            self.claimDetails = response.data.Claim;
            return response;
        });

    };

    this.autocomplete = function(value, type) {
        var config = {};
        config[type] = value;

        return searchSrv.fetchAutocomplete(apiPath + 'projectaddresses/', config).then(function() {

            return searchSrv.autocomplete.ProjectAddresss;
        });
    };

    this.saveProjectAddress = function(object, formToken) {

        return crudSrv.save('/admin/projects/', object, 'ProjectAddress', formToken);

    };

    this.getProjectAddress = function(id) {
        return crudSrv.getDetails(projectApiPath, id).then(function(response) {
            self.projectAddress = response.data.ProjectAddress;
            return response;
        });
    };

    this.getContacts = function(jobNumber) {
        return crudSrv.getDetails('/admin/contacts/claim/', jobNumber).then(function(response) {
            self.contacts = response.data.ClaimContacts;
        });
    };

    this.saveContact = function(object, formToken) {
        var requestPath;
        if (object.id) {
            requestPath = singleApiPath + 'contacts/' + object.id;
        } else {
            requestPath = singleApiPath + 'contacts/0';
        }
        return crudSrv.save(requestPath, object, 'ClaimContact', formToken);
    };


    this.loadPMList = function(claimId) {
        return crudSrv.getDetails('/admin/staff/pmlist/', claimId).then(function(response) {
            self.staffList = response.data.Staffs;
        });
    };

    this.getClaimLocations = function(projectAddress) {
        return searchSrv.searchCall(claimLocationsApiPath + projectAddress.id + '/0/50');
    };

    this.setInactive = function(object, formToken) {
        var requestPath = removeApiPath + object.id;
        return crudSrv.setInactive(requestPath, formToken);
    };

    this.removeContact = function(object, formToken) {
        return crudSrv.delete(singleApiPath + 'contacts/', object, formToken);
    };

});