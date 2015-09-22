module.service('staffPhotoSrv', function(photoSrv) {
  var apiPath = '/admin/staff/';
  var self = this;
  this.getStaffPhoto = function(staffId) {
    return photoSrv.getPhoto(apiPath + staffId).then(function(response) {
      self.photo = response.data.Staff.imageName;
    });
  };
});
