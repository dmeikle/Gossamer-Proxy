module.controller('claimsEditCtrl', function($scope, claimsEditSrv) {
  $scope.selectedTab = 'comments';

  $scope.selectTab = function(event) {
    $scope.selectedTab = event.target.dataset.tabname;
  };

  $scope.getClaimDetails = function() {
    claimsEditSrv.getClaimDetails(document.getElementById('Claim_id').value).then(function(){

    });
  };
  $scope.getClaimDetails();

});
