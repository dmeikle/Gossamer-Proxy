module.service('subcontractorsEditSrv', function ($http) {
    var apiPath = '/admin/subcontractors/';

    var self = this;

    this.getSubcontractorList = function (row, numRows) {
        return $http.get(apiPath + row + '/' + numRows)
                .then(function (response) {
                    self.subcontractorsList = response.data.Subcontractors;
                    self.subcontractorsCount = response.data.SubcontractorsCount[0].rowCount;
                });
    };

    this.getSubcontractorDetail = function (object) {
        console.log(object);
        return $http.get(apiPath + object.id)
                .then(function (response) {
                    self.subcontractorsDetail = response.data.Subcontractor;
                });
    };


    this.save = function (object, formToken) {
        var copiedObject = jQuery.extend(true, {}, object);
        for (var property in copiedObject) {
            if (copiedObject.hasOwnProperty(property)) {
                if (copiedObject[property] === null) {
                    delete copiedObject[property];
                }
            }
        }
        var requestPath;
        if (!copiedObject.id) {
            requestPath = apiPath + '0';
        } else {
            requestPath = apiPath + copiedObject.id;
        }
        var data = {};
        data.Subcontractor = copiedObject;
        data.FORM_SECURITY_TOKEN = formToken;
        return $http({
            method: 'POST',
            url: requestPath,
            data: data,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });
    };


});
