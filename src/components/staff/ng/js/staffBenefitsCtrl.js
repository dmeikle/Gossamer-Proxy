module.controller('staffBenefitsCtrl', function($scope, $location, $modal, staffBenefitsSrv, templateSrv) {
  // stuff to run on controller load
  $scope.staffBenefits = {};
  $scope.staffBenefitsLoading = true;
  getStaffBenefits();

  function getStaffBenefits(){
    var object = {};
    object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);

    staffBenefitsSrv.getStaffBenefits(object).then(function() {
      $scope.staffBenefits = staffBenefitsSrv.staffBenefits;
      $scope.staffBenefitsLoading = false;
    });
  }

  $scope.openStaffBenefitsHistoryModal = function() {
    var template = templateSrv.staffBenefitsHistoryModal;
    $modal.open({
      templateUrl: template,
      controller: 'staffBenefitsHistoryModalCtrl',
      size: 'lg',
      resolve: {
        staffBenefits: function() {
          return $scope.staffBenefits;
        }
      }
    });
  };
});

module.controller('staffBenefitsHistoryModalCtrl', function($modalInstance, $scope, $location, staffBenefits, staffBenefitsSrv) {
  $scope.staffBenefits = staffBenefits;
  $scope.staff = {};
  $scope.addingNew = false;

  $scope.toggleAddNewBenefits = function() {
    if ($scope.addingNew === true) {
      $scope.addingNew = false;
    } else {
      $scope.addingNew = true;
    }
  };

  $scope.saveNewBenefits = function(object) {
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);

    staffBenefitsSrv.save(object, formToken).then(function() {
      var object = {};
      object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);

      staffBenefitsSrv.getStaffBenefits(object).then(function() {
        $scope.staffBenefits = staffBenefitsSrv.staffBenefits;
      });
    });
  };

  $scope.confirm = function() {
    $modalInstance.close($scope.staffBenefits);
  };

  $scope.close = function() {
    $modalInstance.dismiss('close');
  };
});
