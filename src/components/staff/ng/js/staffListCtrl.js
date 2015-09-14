module.controller('staffListCtrl', function($scope, $modal, staffListSrv, staffEditSrv, templateSrv) {

  // Stuff to run on controller load
  $scope.itemsPerPage = 20;
  $scope.currentPage = 1;

  $scope.basicSearch = {};
  $scope.autocomplete = {};

  $scope.previouslyClickedObject = {};

  var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
  var numRows = $scope.itemsPerPage;

  function getStaffList() {
    staffListSrv.getStaffList(row, numRows).then(function(response) {
      $scope.staffList = staffListSrv.staffList;
      $scope.totalItems = staffListSrv.staffCount;
    }).then(function() {
      $scope.loading = false;
    });
  }

  function fetchAutocomplete() {
    staffListSrv.autocomplete($scope.basicSearch)
      .then(function() {
        $scope.autocomplete = staffListSrv.autocompleteList;
      });
  }

  $scope.openAddNewStaffModal = function() {
    var template = templateSrv.staffAddNewModal;
    var modalInstance = $modal.open({
      templateUrl: template,
      controller:'staffModalCtrl',
      size:'xl'
    });

    modalInstance.result.then(function(staff) {
      staffEditSrv.save(staff).then(function() {
        getStaffList();
      });
    });
  };

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

  $scope.openStaffAdvancedSearchModal = function() {
    var template = templateSrv.staffEditModal;
    var modalInstance = $modal.open({
      templateUrl: template,
      controller: 'staffModalCtrl',
      size: 'lg'
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

  $scope.search = function(searchObject) {
    if (searchObject.val) {
      staffListSrv.filterListBy(row, numRows, searchObject)
        .then(function() {
          if (staffListSrv.searchResults) {
            $scope.staffList = staffListSrv.searchResults;
            $scope.totalItems = staffListSrv.searchResultsCount;
          } else {
            getStaffList();
          }
        });
    } else {
      getStaffList();
    }

  };

  $scope.closeSidePanel = function() {
    $scope.sidePanelOpen = false;
  };

  $scope.selectRow = function(clickedObject) {
    if ($scope.previouslyClickedObject !== clickedObject) {
      $scope.previouslyClickedObject = clickedObject;
      $scope.sidePanelLoading = true;
      staffListSrv.getStaffDetail(clickedObject)
        .then(function() {
          $scope.selectedStaff = staffListSrv.staffDetail;
          $scope.sidePanelOpen = true;
          $scope.sidePanelLoading = false;

        });
    }
  };

  $scope.$watch('currentPage + numPerPage', function() {
    $scope.loading = true;
    row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    numRows = $scope.itemsPerPage;

    getStaffList(row, numRows);
  });

  $scope.$watch('basicSearch.val', function() {
    if ($scope.basicSearch.val !== undefined) {
      $scope.autocomplete.loading = true;
      fetchAutocomplete();
    }
  });
});

module.controller('staffModalCtrl', function($modalInstance, $scope) {
  $scope.staff = {};

  $scope.confirm = function() {
    $modalInstance.close($scope.staff);
  };

  $scope.cancel = function() {
    $modalInstance.dismiss('cancel');
  };
});
