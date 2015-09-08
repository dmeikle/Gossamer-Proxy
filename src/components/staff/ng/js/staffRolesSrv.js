module.service('staffRolesSrv', function($http) {
  var apiPath = '/admin/staff/';

  var self = this;

  this.getStaffRoles = function(object) {
    return $http.get(apiPath + 'permissions/' + object.id)
      .then(function(response) {
        var rolesObject = {};
        for (var role in response.data.roles) {
          if (response.data.roles.hasOwnProperty(role)) {
            rolesObject[response.data.roles[role]] = true;
          }
        }
        self.staffRoles = rolesObject;
      });
  };

  this.saveRoles = function(object, formToken) {
    var id = object.id;
    delete object.loading;
    delete object.id;

    var rolesArray = [];
    for (var role in object) {
      if (object.hasOwnProperty(role)) {
        object[role] = role;
        rolesArray.push(object[role]);
      }
    }

    var data = {};
    data.StaffRole = rolesArray;
    data.FORM_SECURITY_TOKEN = formToken;
    return $http({
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      url: apiPath + 'permissions/' + id,
      data: data
    }).then(function(response) {

    });
  };
});
