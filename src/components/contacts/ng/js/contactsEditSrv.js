module.service('contactsEditSrv', function ($http) {
    var apiPath = '/admin/contacts/';
    var companyApiPath = '/admin/companies/';
    
    var self = this;

    this.getContactList = function (row, numRows) {
        return $http.get(apiPath + row + '/' + numRows)
                .then(function (response) {
                    self.contactsList = response.data.Contacts;
                    self.contactsCount = response.data.ContactsCount[0].rowCount;
                });
    };

    this.getContactDetail = function (object) {
        return $http.get(apiPath + object.id)
                .then(function (response) {
                    self.contactsDetail = response.data.Contact;
                });
    };


    this.getCompany = function(object) {
        return $http.get(companyApiPath + object.id)
                    .then(function (response) {
                        self.company = response.data.Company;
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
        data.Contact = copiedObject;
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