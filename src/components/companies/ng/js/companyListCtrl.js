module.controller('companyListCtrl', function($scope, $modal, staffListSrv, staffEditSrv, templateSrv) {

  // Stuff to run on controller load
  $scope.itemsPerPage = 20;
  $scope.currentPage = 1;

  $scope.basicSearch = {};
  $scope.advancedSearch = {};
  $scope.autocomplete = {};

  $scope.previouslyClickedObject = {};

  var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
  var numRows = $scope.itemsPerPage;

  var apiPath = '/admin/companies/';

  function getList() {
    $scope.loading = true;
    companyListSrv.getList(row, numRows).then(function(response) {
      $scope.companyList = companyListSrv.companyList;
      $scope.totalItems = companyListSrv.companyCount;
    }).then(function() {
      $scope.loading = false;
    });
  }

  $scope.openAddNewModal = function() {
    var template = companyTemplateSrv.AddNewModal;
    var modalInstance = $modal.open({
      templateUrl: template,
      controller: 'companyModalCtrl',
      size: 'xl'
    });

    modalInstance.result.then(function(staff) {
      companyEditSrv.save(staff).then(function() {
        getStaffList();
      });
    });
  };


  $scope.openCompanyAdvancedSearch = function() {
    $scope.sidePanelOpen = true;
    $scope.selectedStaff = undefined;
    $scope.sidePanelLoading = true;
    companyListSrv.getAdvancedSearchFilters().then(function() {
      $scope.sidePanelLoading = false;
      $scope.searching = true;
    });
  };

  $scope.resetAdvancedSearch = function() {
    $scope.advancedSearch.query = {};
    getCompanyList();
  };

  $scope.search = function(searchObject) {
    if (searchObject && Object.keys(searchObject).length > 0) {
      $scope.searchSubmitted = true;
      $scope.loading = true;
      companyListSrv.search(searchObject).then(function() {
        $scope.staffList = companyListSrv.searchResults;
        $scope.totalItems = companyListSrv.searchResultsCount;
        $scope.loading = false;
      });
    }
  };

  $scope.resetSearch = function() {
    $scope.searchSubmitted = false;
    $scope.basicSearch.query = {};
    getCompanyList();
  };

  $scope.closeSidePanel = function() {
    if ($scope.searching) {
      $scope.searching = false;
    }
    if ($scope.selectedCompany) {
      $scope.selectedCompany = undefined;
      $scope.previouslyClickedObject = undefined;
    }
    if (!$scope.selectedCompany && !$scope.searching) {
      $scope.sidePanelOpen = false;
    }
  };

  $scope.selectRow = function(clickedObject) {
    $scope.searching = false;
    $scope.sidePanelLoading = true;
    $scope.sidePanelOpen = true;
    if ($scope.previouslyClickedObject !== clickedObject) {
      $scope.previouslyClickedObject = clickedObject;
      copmanyListSrv.getStaffDetail(clickedObject)
        .then(function() {
          $scope.selectedCompany = companyListSrv.staffDetail;
          $scope.sidePanelLoading = false;
        });
    }
  };

  $scope.$watch('currentPage + numPerPage', function() {
    $scope.loading = true;
    row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    numRows = $scope.itemsPerPage;

    getCopmanyList(row, numRows);
  });
});

module.controller('companyModalCtrl', function($modalInstance, $scope) {
  $scope.staff = {};

  $scope.confirm = function() {
    $modalInstance.close($scope.staff);
  };

  $scope.cancel = function() {
    $modalInstance.dismiss('cancel');
  };
});
