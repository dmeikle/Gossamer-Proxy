module.service('claimsEditSrv', function(crudSrv, searchSrv) {
    var objectType = 'Claim';
    var apiPath = '/admin/claims/';
    var singleApiPath = '/admin/claim/';
    var projectApiPath = '/admin/projects/';
    var claimLocationsApiPath = '/admin/claimlocations/';

    var self = this;



    this.save = function(object, formToken, page) {

        var requestPath;
        if (object.id) {
            requestPath = singleApiPath + page + '/' + object.id;
        } else {
            requestPath = singleApiPath + page + '/0';
        }
        var copiedObject = angular.copy(object);
        if (object.date) {
            copiedObject.date = object.date.toISOString().substring(0, 10);
        }
        return crudSrv.save(requestPath, copiedObject, objectType, formToken);

    };


    this.getClaimDetails = function(id) {

        return crudSrv.getDetails(apiPath, id).then(function(response) {
            self.claimDetails = response.data.Claim;
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
        });
    };

    this.getContacts = function(jobNumber) {
        return crudSrv.getDetails('/admin/contacts/claim/', jobNumber).then(function(response) {
            self.contacts = response.data.ClaimContacts;
        });
    };

    
    this.loadPMList = function(claimId) {
        return crudSrv.getDetails('/admin/staff/pmlist/', claimId).then(function (response) {
            self.staffList = response.data.Staffs;
        });
    };

    this.getClaimLocations = function(projectAddress) {
        return searchSrv.searchCall(claimLocationsApiPath + projectAddress.id + '/0/10');
    };
});