module.service('staffBenefitsSrv', function($http) {
  var self = this;

  var apiPath = '/admin/staff/benefits/';

  this.getStaffBenefits = function(object) {
    return $http.get(apiPath + object.id).then(function(response) {
      for (var benefits in response.data.StaffBenefits) {
        if (response.data.StaffBenefits.hasOwnProperty(benefits)) {
          response.data.StaffBenefits[benefits].startDate = new Date(response.data.StaffBenefits[benefits].startDate);
        }
      }
      self.staffBenefits = response.data.StaffBenefits;
    });
  };

  this.save = function(object, formToken) {

    var data = {};
    data.StaffBenefits = object;
    data.FORM_SECURITY_TOKEN = formToken;
    return $http({
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      url: apiPath + object.id,
      data: data
    });
  };
});
