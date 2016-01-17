module.service('staffEmergencyContactsSrv', function ($http) {
    var apiPath = '/admin/staff/emergencycontacts/';
    var self = this;

    this.getStaffEmergencyInfo = function (object) {
        return $http.get(apiPath + object.id).then(function (response) {
               
            return response.data.EmergencyContacts;            
        });
    };

    this.save = function (object, formToken) {
        var contactId;
        if (!object.id) {
            contactId = '0';
        } else {
            contactId = object.StaffEmergencyContacts_id;
        }
        var data = {};
        data.StaffEmergencyContact = object;
        data.FORM_SECURITY_TOKEN = formToken;
        return $http({
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: apiPath + object.staffId + '/' + contactId,
            data: data
        });
    };

    this.delete = function (object, formToken) {
        return $http({
            method: 'DELETE',
            url: apiPath + object.Staff_id + '/' + object.StaffEmergencyContacts_id
        });
    };
});
