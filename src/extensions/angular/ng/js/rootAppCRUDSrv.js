module.service('crudSrv', function($http) {

    function parseData(data) {
        for (var property in data) {
            if (typeof data[property] === 'object' && data[property] !== null) {
                parseData(data[property]);
            } else {
                if (property.slice(-3) === '_id' && !data[property]) {
                    delete data[property];
                }
            }
        }
    }

    this.save = function(apiPath, object, objectType, formToken) {

        var requestPath;
        if (!object.id || object.id === '') {
            requestPath = apiPath + '0';
        } else {
            requestPath = apiPath + object.id;
        }
        var data = {};
        data[objectType] = object;
        data.FORM_SECURITY_TOKEN = formToken;

        parseData(data);

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


    this.saveMultiple = function(apiPath, object, formToken) {

        var data = object;
        data.FORM_SECURITY_TOKEN = formToken;

        parseData(data);

        return $http({
            method: 'POST',
            url: apiPath,
            data: data,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });
    };

    this.getDetails = function(apiPath, id) {
        return $http({
            method: 'GET',
            url: apiPath + id
        });
    };
    
    this.getTemplate = function(apiPath) {
        return $http({
            method: 'GET',
            url: apiPath
        });
    };

    this.getList = function(apiPath, row, numRows, config) {
        if (config) {
            return $http({
                method: 'GET',
                url: apiPath + row + '/' + numRows,
                params: config
            });
        }
        return $http({
            method: 'GET',
            url: apiPath + row + '/' + numRows
        });
    };

    this.delete = function(apiPath, object, formToken) {
        var config = {};
        config.FORM_SECURITY_TOKEN = formToken;
        return $http({
            method: 'DELETE',
            url: apiPath + object.id,
            config: config
        });
    };

    this.setInactive = function(requestPath, formToken) {
        var config = {};
        config.FORM_SECURITY_TOKEN = formToken;

        parseData(config);

        return $http({
            method: 'POST',
            url: requestPath,
            params: config
        });
    };
});