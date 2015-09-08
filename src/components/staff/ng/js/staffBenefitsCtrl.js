module.controller('staffBenefitsCtrl', function($scope, $location, staffBenefitsSrv) {
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
});
