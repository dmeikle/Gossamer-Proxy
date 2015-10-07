module.controller('blogsPhotoCtrl', function($scope, $location, blogsPhotoSrv) {
  var blogsId = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);
  $scope.dropzoneConfig = {
    'options': { // passed into the Dropzone constructor
      'url': '/admin/blogs/photo/upload/' + blogsId,
      'uploadMultiple':false,
      'dictDefaultMessage':''
    },
    'eventHandlers': {
      'sending': function (file, xhr, formData) {
      },
      'success': function (file, response) {
        getBlogPhoto();
      }
    }
  };

  getBlogPhoto = function() {
    blogsPhotoSrv.getBlogPhoto(blogsId);
  };
});
