module.controller('projectAddressEditCtrl', function($scope, $location, projectAddressesEditSrv) {

  // Run on load
  $scope.loading = true;
  $scope.authorizationLoading = true;
  $scope.authorization = {};
  $scope.isOpen = {};
  getProjectAddressDetail();

  // datepicker stuffs
  $scope.dateOptions = {'starting-day':1};
  $scope.openDatepicker = function(event) {
    var datepicker = event.target.parentElement.dataset.datepickername;
    $scope.isOpen[datepicker] = true;
  };

  function getProjectAddressDetail() {
    var object = {};
    object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);

    projectAddressesEditSrv.getProjectAddressDetail(object).then(function() {
      $scope.project = projectAddressesEditSrv.projectAddress;
      console.log($scope.project);
      $scope.loading = false;
    });
  }

  $scope.save = function(object) {
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    projectAddressesEditSrv.save(object, formToken).then(function() {
      if ($location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length) === '0') {
        window.location.pathname = '/admin/projects/edit/' + projectAddressesEditSrv.projectAddressDetail.id;
      }
      getProjectAddressDetail();
    });
  };

  $scope.discardChanges = function() {
    getProjectAddressDetail();
  };


  $scope.clearErrors = function() {
    $scope.credentialStatus = undefined;
  };
});
