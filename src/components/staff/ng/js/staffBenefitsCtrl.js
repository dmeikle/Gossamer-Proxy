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

module.controller('staffBenefitsHistoryModalCtrl', function($modalInstance, $scope, staffBenefits) {
  $scope.staffBenefits = staffBenefits;

  $scope.addingNew = false;

  $scope.addNewBenefits = function() {
    $scope.addingNew = true;
  };

  $scope.confirm = function() {
    $modalInstance.close($scope.staffBenefits);
  };

  $scope.cancel = function() {
    $modalInstance.dismiss('cancel');
  };
});
