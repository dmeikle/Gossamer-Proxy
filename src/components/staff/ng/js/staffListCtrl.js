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
    $scope.loading = true;
    staffListSrv.getStaffList(row, numRows).then(function(response) {
      $scope.staffList = staffListSrv.staffList;
      $scope.totalItems = staffListSrv.staffCount;
    }).then(function() {
      $scope.loading = false;
    });
  }

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

  $scope.resetAdvancedSearch = function() {
    $scope.advancedSearch.query = {};
    getStaffList();
  };

  $scope.search = function(searchObject) {
    if (searchObject && Object.keys(searchObject).length > 0) {
      $scope.searchSubmitted = true;
      $scope.loading = true;
      staffListSrv.search(searchObject).then(function() {
        $scope.staffList = staffListSrv.searchResults;
        $scope.totalItems = staffListSrv.searchResultsCount;
        $scope.loading = false;
      });
    }
  };

  $scope.resetSearch = function() {
    $scope.searchSubmitted = false;
    $scope.basicSearch.query = {};
    getStaffList();
  };

  $scope.closeSidePanel = function() {
    if ($scope.searching) {
      $scope.searching = false;
    }
    if ($scope.selectedStaff) {
      $scope.selectedStaff = undefined;
      $scope.previouslyClickedObject = undefined;
    }
    if (!$scope.selectedStaff && !$scope.searching) {
      $scope.sidePanelOpen = false;
    }
  };

  $scope.selectRow = function(clickedObject) {
    $scope.searching = false;
    $scope.sidePanelLoading = true;
    $scope.sidePanelOpen = true;
    if ($scope.previouslyClickedObject !== clickedObject) {
      $scope.previouslyClickedObject = clickedObject;
      staffListSrv.getStaffDetail(clickedObject)
        .then(function() {
          $scope.selectedStaff = staffListSrv.staffDetail;
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
