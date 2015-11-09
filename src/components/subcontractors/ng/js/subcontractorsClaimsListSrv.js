module.service('subcontractorsClaimsListSrv', function ($http, searchSrv) {

    var apiPath = '/admin/subcontractors/claims/';

    var self = this;


    this.getClaimsList = function (subcontractorsId) {
        return $http.get(apiPath + subcontractorsId)
                .then(function (response) {
                    self.claimsList = response.data.Claims;
                    //self.claimsCount = response.data[0].Claims.rowCount;
                });
    };


});
