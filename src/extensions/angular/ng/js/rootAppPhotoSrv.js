module.service('photoSrv', function ($http) {
    this.getPhoto = function (apiPath) {
        return $http({
            url: apiPath,
            method: 'GET'
        });
    };
});
