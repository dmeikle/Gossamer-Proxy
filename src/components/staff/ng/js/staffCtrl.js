module.controller('staffListCtrl', function($scope, $modal, staffListSrv, templateSrv) {

  // Stuff to run on controller load
  $scope.itemsPerPage = 20;
  $scope.currentPage = 1;

  $scope.basicSearch = {};
  $scope.autocomplete = {};

  var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
  var numRows = $scope.itemsPerPage;

  function getStaffList() {
    staffListSrv.getStaffList(row, numRows).then(function(response){
      $scope.staffList = staffListSrv.staffList;
      $scope.totalItems = staffListSrv.staffCount;
    }).then(function() {
      $scope.loading = false;
    });
  }

  function fetchAutocomplete() {
    staffListSrv.autocomplete($scope.basicSearch)
      .then(function(){
        $scope.autocomplete = staffListSrv.autocompleteList;
      });
  }

  $scope.openStaffScheduleModal = function(staff) {
    var template = templateSrv.staffScheduleModal;
    $modal.open({
      templateUrl: template,
      controller: 'staffModalCtrl',
      size: 'lg',
      resolve: {
        staff: function() {
          return staff;
        }
      }
    });
  };

  $scope.openStaffEditModal = function(staff) {
    var template = templateSrv.staffEditModal;
    var modalInstance = $modal.open({
      templateUrl: template,
      controller: 'staffModalCtrl',
      size: 'lg',
      resolve: {
        staff: function() {
          return staff;
        }
      }
    });

    modalInstance.result
      .then(function(staff) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        staffListSrv.saveStaff(staff, formToken)
          .then(function() {
            getStaffList();
          });
      });
  };

  $scope.submitBasicSearch = function(searchObject) {
    staffListSrv.basicSearch(searchObject);
  };

  $scope.$watch('currentPage + numPerPage', function() {
    $scope.loading = true;
    row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    numRows = $scope.itemsPerPage;

    getStaffList(row, numRows);
  });

  $scope.$watch('basicSearch.val', function(){
    if ($scope.basicSearch.val !== undefined) {
      $scope.autocomplete.loading = true;
      fetchAutocomplete();
    }
  });
});

module.controller('staffModalCtrl', function($modalInstance, $scope, staff){
  $scope.staff = staff;

  $scope.confirm = function() {
    $modalInstance.close($scope.staff);
  };

  $scope.cancel = function() {
    $modalInstance.dismiss('cancel');
  };
});
