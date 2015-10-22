module.service('claimsEditSrv', function (crudSrv, searchSrv) {
    var objectType = 'Claim';
    var apiPath = '/admin/claims/';
    var singleApiPath = '/admin/claim/';
    var projectApiPath = '/admin/projects/';
    
    var self = this;



    this.save = function (object, formToken, page) {
        var requestPath = singleApiPath + page + '/';
        var copiedObject = angular.copy(object);
        copiedObject.date = object.date.toISOString().substring(0, 10);
        return crudSrv.save(copiedObject, objectType, formToken, requestPath);
    };


    this.getClaimDetails = function (id) {
     
        return crudSrv.getDetails(apiPath, id).then(function (response) {
            self.claimDetails = response.data.Claim;
        });

    };

    this.autocomplete = function (value, type) {
        var config = {};
        config[type] = value;
        return searchSrv.fetchAutocomplete(config, apiPath + 'projectaddresses/').then(function () {
            return searchSrv.autocomplete.ProjectAddresss;
        });
    };

    this.saveProjectAddress = function (object, formToken) {
        return crudSrv.save(object, 'ProjectAddress', formToken, '/admin/projects/');
    };

    this.getProjectAddress = function (id) {        
        return crudSrv.getDetails(projectApiPath, id).then(function (response) {
            self.projectAddress = response.data.ProjectAddress;
        });
    };
    
    this.getContacts = function(jobNumber) {
        return crudSrv.getDetails('/admin/contacts/claim/', jobNumber).then(function (response) {
            self.contacts = response.data.ClaimContacts;
        });
    };
});
