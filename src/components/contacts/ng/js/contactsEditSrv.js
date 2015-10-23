module.service('contactsEditSrv', function ($http) {
    var apiPath = '/admin/contacts/';

    var self = this;

    this.getContactList = function (row, numRows) {
        return $http.get(apiPath + row + '/' + numRows)
                .then(function (response) {
                    self.contactsList = response.data.Contacts;
                    self.contactsCount = response.data.ContactsCount[0].rowCount;
                });
    };

    this.getContactDetail = function (object) {
        console.log(object);
        return $http.get(apiPath + object.id)
                .then(function (response) {
//        if (response.data.Contact.dob) {
//          response.data.Contact.dob = new Date(response.data.Contact.dob);
//        }
//        if (response.data.Contact.hireDate) {
//          response.data.Contact.hireDate = new Date(response.data.Contact.hireDate);
//        }
//        if (response.data.Contact.departureDate) {
//          response.data.Contact.departureDate = new Date(response.data.Contact.departureDate);
//        }
                    self.contactsDetail = response.data.Contact;
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