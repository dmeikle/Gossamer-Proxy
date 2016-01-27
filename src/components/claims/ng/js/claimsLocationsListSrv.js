module.service('claimsLocationsListSrv', function($http) {
    var apiPath = '/admin/claims/locations/claim/';

    this.getList = function(claimId) {
        return $http.get(apiPath + claimId);
    };

});