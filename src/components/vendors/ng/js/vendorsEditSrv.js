module.service('vendorsEditSrv', function ($http) {
    var apiPath = '/admin/vendors/';

    var self = this;

    this.getVendorList = function (row, numRows) {
        return $http.get(apiPath + row + '/' + numRows)
                .then(function (response) {
                    self.companyList = response.data.Vendors;
                    self.companyCount = response.data.VendorsCount[0].rowCount;
                });
    };

    this.getVendorDetail = function (object) {
        console.log(object);
        return $http.get(apiPath + object.id)
                .then(function (response) {
//        if (response.data.Vendor.dob) {
//          response.data.Vendor.dob = new Date(response.data.Vendor.dob);
//        }
//        if (response.data.Vendor.hireDate) {
//          response.data.Vendor.hireDate = new Date(response.data.Vendor.hireDate);
//        }
//        if (response.data.Vendor.departureDate) {
//          response.data.Vendor.departureDate = new Date(response.data.Vendor.departureDate);
//        }
                    self.companyDetail = response.data.Vendor;
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
console.log(copiedObject);
        var requestPath;
        if (!copiedObject.id) {
            requestPath = apiPath + '0';
        } else {
            requestPath = apiPath + copiedObject.id;
        }
        var data = {};
        data.Vendor = copiedObject;
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
