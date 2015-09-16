module.controller('staffListCtrl', function($scope, $modal, staffListSrv, staffEditSrv, templateSrv) {

  // Stuff to run on controller load
  $scope.itemsPerPage = 20;
  $scope.currentPage = 1;

  $scope.basicSearch = {};
  $scope.advancedSearch = {};
  $scope.autocomplete = {};

  $scope.previouslyClickedObject = {};

  var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
  var numRows = $scope.itemsPerPage;

  var apiPath = '/admin/staff/';

  function getStaffList() {
    staffListSrv.getStaffList(row, numRows).then(function(response) {
      $scope.staffList = staffListSrv.staffList;
      $scope.totalItems = staffListSrv.staffCount;
    }).then(function() {
      $scope.loading = false;
    });
  }

  $scope.fetchAutocomplete = function(searchObject) {
    staffListSrv.autocomplete(searchObject)
      .then(function() {
        $scope.autocomplete = staffListSrv.autocompleteList;
      });
  };

  $scope.openAddNewStaffModal = function() {
    var template = templateSrv.staffAddNewModal;
    var modalInstance = $modal.open({
      templateUrl: template,
      controller: 'staffModalCtrl',
      size: 'xl'
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

  $scope.openStaffAdvancedSearch = function() {
    $scope.sidePanelOpen = true;
    $scope.selectedStaff = undefined;
    $scope.sidePanelLoading = true;
    staffListSrv.getAdvancedSearchFilters().then(function() {
      $scope.sidePanelLoading = false;
      $scope.searching = true;
    });
  };

  $scope.search = function(searchObject) {
    if (searchObject) {
      staffListSrv.filterListBy(row, numRows, searchObject, apiPath)
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
    if ($scope.searching) {
      $scope.searching = false;
    }
    if ($scope.selectedStaff) {
      $scope.selectedStaff = undefined;
    }
    if (!$scope.selectedStaff && !$scope.searching) {
      $scope.sidePanelOpen = false;
    }
  };

  $scope.selectRow = function(clickedObject) {
    $scope.searching = false;
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
