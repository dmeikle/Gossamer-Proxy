module.controller('contactsListCtrl', function($scope, $modal, contactsListSrv, contactsEditSrv, contactsTemplateSrv, tablesSrv, contactsClaimsListSrv) {

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
      $scope.contactsList = tablesSrv.sortResult.Contacts;
      $scope.loading = false;
    }
  });

  var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
  var numRows = $scope.itemsPerPage;

  function getContactList() {
    $scope.loading = true;
    contactsListSrv.getContactList(row, numRows).then(function(response) {
      $scope.contactsList = contactsListSrv.contactsList;
      $scope.totalItems = contactsListSrv.contactsCount;
    }).then(function() {
      $scope.loading = false;
    });
  }

  $scope.openAddNewContactModal = function() {
    var template = contactsTemplateSrv.AddNewModal;
    var modalInstance = $modal.open({
      templateUrl: template,
      controller: 'contactsModalCtrl',
      size: 'xl'
    });

    modalInstance.result.then(function(contact) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        
      contactsEditSrv.save(contact, formToken).then(function() {
        getContactList();
      });
    });
  };


  $scope.openContactAdvancedSearch = function() {
    $scope.sidePanelOpen = true;
    $scope.selectedContact = undefined;
    $scope.sidePanelLoading = true;
    contactsListSrv.getAdvancedSearchFilters().then(function() {
      $scope.sidePanelLoading = false;
      $scope.searching = true;
    });
  };

  $scope.resetAdvancedSearch = function() {
    $scope.advancedSearch.query = {};
    getContactList();
  };

  $scope.search = function(searchObject) {
    if (searchObject && Object.keys(searchObject).length > 0) {
      $scope.searchSubmitted = true;
      $scope.loading = true;
      contactsListSrv.search(searchObject).then(function() {
        $scope.contactsList = contactsListSrv.searchResults;        
        $scope.totalItems = contactsListSrv.searchResultsCount;
        $scope.loading = false;
      });
    }
  };

  $scope.resetSearch = function() {
    $scope.searchSubmitted = false;
    $scope.basicSearch.query = {};
    getContactList();
  };

  $scope.closeSidePanel = function() {
    if ($scope.searching) {
      $scope.searching = false;
    }
    if ($scope.selectedContact) {
      $scope.selectedContact = undefined;
      $scope.previouslyClickedObject = undefined;
    }
    if (!$scope.selectedContact && !$scope.searching) {
      $scope.sidePanelOpen = false;
    }
  };

  $scope.selectRow = function(clickedObject) {
      
    $scope.searching = false;
    $scope.sidePanelLoading = true;
    $scope.sidePanelOpen = true;
    if ($scope.previouslyClickedObject !== clickedObject) {
      $scope.previouslyClickedObject = clickedObject;
      contactsClaimsListSrv.getClaimsList(clickedObject.id, 0, 100)
        .then(function() {
          $scope.selectedContact = clickedObject;
          $scope.claimsList = contactsClaimsListSrv.claimsList;
          $scope.sidePanelLoading = false;
        });
    }
  };

  $scope.$watch('currentPage + numPerPage', function() {
    $scope.loading = true;
    row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    numRows = $scope.itemsPerPage;

    getContactList(row, numRows);
  });
});

module.controller('contactsModalCtrl', function($modalInstance, $scope) {
  $scope.contacts = {};

  $scope.confirm = function(contact) {
    $modalInstance.close($scope.contact);
  };

  $scope.cancel = function() {
    $modalInstance.dismiss('cancel');
  };
});