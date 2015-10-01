module.controller('claimsEditCtrl', function($scope) {
  $scope.selectedTab = 'comments';

  $scope.selectTab = function(event) {
    $scope.selectedTab = event.target.dataset.tabname;
  };
});
