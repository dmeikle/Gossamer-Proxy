
module.controller('staffListCtrl', function($scope, $modal, staffListSrv, staffEditSrv, templateSrv, tablesSrv, toastsSrv) {

  $scope.newAlert = toastsSrv.newAlert;
  // Stuff to run on controller load
  $scope.itemsPerPage = 20;
  $scope.currentPage = 1;

  $scope.basicSearch = {};
  $scope.advancedSearch = {};
  $scope.autocomplete = {};

  $scope.previouslyClickedObject = {};

  // Load up the table service so we can watch it!
  $scope.tablesSrv = tablesSrv;
  $scope.$watch('tablesSrv.sortResult', function() {
    if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
      $scope.staffList = tablesSrv.sortResult.Staffs;
      $scope.loading = false;
    }
  });

  var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
  var numRows = $scope.itemsPerPage;

  var apiPath = '/admin/staff/';

  $scope.setItemsPerPage = function(number) {
    $scope.itemsPerPage = number;
    row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    numRows = $scope.itemsPerPage;
  };

  function getStaffList() {
    $scope.loading = true;
    staffListSrv.getStaffList(row, numRows).then(function(response) {
      $scope.staffList = staffListSrv.staffList;
      $scope.totalItems = staffListSrv.staffCount;
    }).then(function() {
      $scope.loading = false;
    });
  }

  $scope.fetchAutocomplete = function(viewVal) {
    var searchObject = {};
    searchObject.name = viewVal;

    return staffListSrv.fetchAutocomplete(searchObject);
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

  $scope.resetAdvancedSearch = function() {
    $scope.advancedSearch.query = {};
    getStaffList();
  };

  $scope.search = function(searchObject) {
    $scope.noResults = undefined;
    var copiedObject = angular.copy(searchObject);
    if (copiedObject && Object.keys(copiedObject).length > 0) {
      $scope.searchSubmitted = true;
      $scope.loading = true;
      staffListSrv.search(copiedObject).then(function() {
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
    $scope.sidePanelOpen = true;
    if ($scope.previouslyClickedObject !== clickedObject) {
      $scope.previouslyClickedObject = clickedObject;
      $scope.sidePanelLoading = true;
      staffListSrv.getStaffDetail(clickedObject)
        .then(function() {
          $scope.selectedStaff = staffListSrv.staffDetail;
          $scope.sidePanelLoading = false;
        });
    }
  };

  $scope.$watch('currentPage + itemsPerPage', function() {
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
