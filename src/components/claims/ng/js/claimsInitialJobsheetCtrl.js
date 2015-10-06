module.controller('initialJobsheetCtrl', function($scope, $location, claimsInitialJobsheetSrv, claimsEditSrv) {
  var a = document.createElement('a');
  a.href = $location.absUrl();
  var apiPath;
  if (a.pathname.lastIndexOf('/') !== a.pathname.length - 1) {
    apiPath = a.pathname;
  } else {
    apiPath = a.pathname.slice(0, -1);
  }

  var ids = apiPath.slice(apiPath.indexOf('jobsheet') + 9);

  $scope.loading = true;
  $scope.jobSheet = new AngularQueryObject();
  $scope.jobSheet.query.contacts = [];
  $scope.jobSheet.query.contacts.push({});

  $scope.getClaimDetails = function() {
    claimsEditSrv.getClaimDetails(ids.slice(ids.lastIndexOf('/') + 1)).then(function(response) {
      $scope.claim = response.data.claim;
      claimsEditSrv.getProjectAddress($scope.claim.ProjectAddresses_id).then(function(response) {
        $scope.projectAddress = response.data.ProjectAddress;
        $scope.loading = false;
      });
    });
  };
  $scope.getClaimDetails();

  $scope.addOwnerTenant = function() {
    $scope.jobSheet.query.contacts.push({});
  };

  $scope.removeOwnerTenant = function(e, index) {
    e.preventDefault();
    $scope.jobSheet.query.contacts.splice(index, 1);
  };

  $scope.submit = function(object) {
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    object.claimLocation = $scope.ClaimLocation;
    claimsInitialJobsheetSrv.save(object, formToken, ids);
  };
});
