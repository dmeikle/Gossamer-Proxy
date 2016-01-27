module.service('companyClaimsListSrv', function ($http, searchSrv) {

    var apiPath = '/admin/companies/claims/';

    var self = this;


    this.getClaimsList = function (companyId) {
        return $http.get(apiPath + companyId)
                .then(function (response) {
                    self.claimsList = response.data.Claims;
                    self.claimsCount = response.data.ClaimsCount[0].rowCount;
                });
    };


});
