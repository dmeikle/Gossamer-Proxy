module.service('subcontractorsClaimsListSrv', function ($http, searchSrv) {

    var apiPath = '/admin/subcontractors/claims/';

    var self = this;


    this.getClaimsList = function (subcontractorsId, start, numRows) {
        return $http.get(apiPath + subcontractorsId + '/' + start + '/' + numRows)
                .then(function (response) {
                    self.claimsList = response.data.Claims;
                    self.claimsCount = response.data.ClaimsCount[0].rowCount;
                });
    };


});
