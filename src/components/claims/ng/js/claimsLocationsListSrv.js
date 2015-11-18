module.service('claimsLocationsListSrv', function($http) {
    var apiPath = '/admin/claimlocations/claim/';

    this.getList = function(claimId) {
        return $http.get(apiPath + claimId);
    };

});