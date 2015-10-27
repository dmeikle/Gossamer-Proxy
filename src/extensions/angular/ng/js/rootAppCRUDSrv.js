module.service('crudSrv', function ($http) {
    this.save = function (object, objectType, formToken, apiPath) {
        var requestPath;
        if (!object.id || object.id === '') {
            requestPath = apiPath + '0';
        } else {
            requestPath = apiPath + object.id;
        }
        var data = {};
        data[objectType] = object;
        data.FORM_SECURITY_TOKEN = formToken;
        return $http({
            method: 'POST',
            // url: requestPath,
            url: apiPath,
            data: data,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });
    };

    this.saveMultiple = function (object, formToken, apiPath) {
        var data = object;
        data.FORM_SECURITY_TOKEN = formToken;
        return $http({
            method: 'POST',
            url: apiPath,
            data: data,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });
    };

    this.getDetails = function (apiPath, id) {
        return $http({
            method: 'GET',
            url: apiPath + id
        });
    };

    this.getList = function (apiPath, row, numRows) {
        return $http({
            method: 'GET',
            url: apiPath + row + '/' + numRows
        });
    };

    this.delete = function (apiPath, object, formToken) {
        var config = {};
        config.FORM_SECURITY_TOKEN = formToken;
        return $http({
            method: 'DELETE',
            url: apiPath + object.id,
            config: config
        });
    };
});
