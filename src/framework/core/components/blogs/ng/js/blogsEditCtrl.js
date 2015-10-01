module.controller('blogsEditCtrl', function($scope, $location, blogsEditSrv, blogsPhotoSrv) {

  // Run on load
  $scope.loading = true;
  $scope.authorizationLoading = true;
  $scope.authorization = {};
  $scope.isOpen = {};
  getBlogDetail();

  // Load blogsPhotoSrv so we can watch it
  $scope.blogsPhotoSrv = blogsPhotoSrv;
  $scope.$watch('blogsPhotoSrv.photo', function() {
    if ($scope.blogsPhotoSrv.photo !== undefined && $scope.blogs.imageName !== undefined) {
      $scope.blogs.imageName = $scope.blogsPhotoSrv.photo;
    }
  });

  // datepicker stuffs
  $scope.dateOptions = {'starting-day':1};
  $scope.openDatepicker = function(event) {
    var datepicker = event.target.parentElement.dataset.datepickername;
    $scope.isOpen[datepicker] = true;
  };

  function getBlogDetail() {
    var object = {};
    object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);

    blogsEditSrv.getBlogDetail(object).then(function() {
      $scope.blogs = blogsEditSrv.blogsDetail;
      $scope.loading = false;

      blogsEditSrv.getBlogCreds(object).then(function() {
        $scope.authorization.username = blogsEditSrv.blogsCreds.username;
        $scope.authorizationLoading = false;
      });
    });
  }

  $scope.save = function(object) {
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    blogsEditSrv.save(object, formToken).then(function() {
      if ($location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length) === '0') {
        window.location.pathname = '/admin/blogs/edit/' + blogsEditSrv.blogsDetail.id;
      }
      getBlogDetail();
    });
  };

  $scope.discardChanges = function() {
    getBlogDetail();
  };

  $scope.submitCredentials = function(object) {
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    object.id = $scope.blogs.id;
    switch (object.emailUser) {
      case true:
        blogsEditSrv.generateEmailReset(object, formToken);
        break;
      default:
        blogsEditSrv.saveCredentials(object, formToken).then(function(){
          $scope.credentialStatus = blogsEditSrv.credentialStatus;
        });
    }
  };

  $scope.resetCredentials = function() {
    $scope.authorization.username = blogsEditSrv.blogsCreds.username;
    $scope.authorization.password = undefined;
    $scope.authorization.passwordConfirm = undefined;
  };

  $scope.clearErrors = function() {
    $scope.credentialStatus = undefined;
  };
});
