module.controller('staffListCtrl', function($scope, $modal, staffSrv, templateSrv) {

  // Stuff to run on controller load
  $scope.itemsPerPage = 20;
  $scope.currentPage = 1;

  $scope.basicSearch = {};
  $scope.autocomplete = {};

  var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
  var numRows = $scope.itemsPerPage;

  function getStaffList() {
    staffSrv.getStaffList(row, numRows).then(function(response) {
      $scope.staffList = staffSrv.staffList;
      $scope.totalItems = staffSrv.staffCount;
    }).then(function() {
      $scope.loading = false;
    });
  }

  function fetchAutocomplete() {
    staffSrv.autocomplete($scope.basicSearch)
      .then(function() {
        $scope.autocomplete = staffSrv.autocompleteList;
      });
  }

  function openSidePanel(clickedObject) {
    $scope.selectedStaff = clickedObject;
  }

  function closeSidePanel() {
    $scope.selectedStaff = undefined;
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
        staffSrv.saveStaff(staff, formToken)
          .then(function() {
            getStaffList();
          });
      });
  };

  $scope.search = function(searchObject) {
    if (searchObject.val) {
      staffSrv.filterListBy(row, numRows, searchObject)
        .then(function() {
          if (staffSrv.searchResults) {
            $scope.staffList = staffSrv.searchResults;
            $scope.totalItems = staffSrv.searchResultsCount;
          } else {
            getStaffList();
          }
        });
    } else {
      getStaffList();
    }

  };

  $scope.selectRow = function(clickedObject) {
    $scope.selectedStaff = undefined;
    if (clickedObject.clicked === undefined || clickedObject.clicked === false) {
      clickedObject.clicked = true;
      staffSrv.getStaffDetail(clickedObject)
        .then(function() {
          openSidePanel(staffSrv.staffDetail);
        });
      return;
    }
    clickedObject.clicked = false;
    closeSidePanel();
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

module.controller('staffModalCtrl', function($modalInstance, $scope, staff) {
  $scope.staff = staff;

  $scope.confirm = function() {
    $modalInstance.close($scope.staff);
  };

  $scope.cancel = function() {
    $modalInstance.dismiss('cancel');
  };
});


// EDIT controller

module.controller('staffEditCtrl', function($scope, $location, staffSrv) {

  // Run on load
  getStaffDetail();

  function getStaffDetail() {
    var object = {};
    object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/')+1, $location.absUrl().length);

    staffSrv.getStaffDetail(object).then(function() {
      $scope.staff = staffSrv.staffDetail;
    });
  }
});
