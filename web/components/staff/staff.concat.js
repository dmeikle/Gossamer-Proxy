var module = angular.module('staff', ['ui.bootstrap']);

module.config(function ($httpProvider) {
    $httpProvider.defaults.transformRequest = function(data){
        if (data === undefined) {
            return data;
        }
        return $.param(data);
    };
});

module.controller('staffListCtrl', function($scope, $modal, staffListSrv, templateSrv) {
  function getStaffList() {
    staffListSrv.getStaffList(row, numRows).then(function(response){
      $scope.staffList = staffListSrv.staffList;
      $scope.totalItems = staffListSrv.staffCount;
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

  $scope.$watch('currentPage + numPerPage', function() {
    row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    numRows = $scope.itemsPerPage;

    getStaffList(row, numRows);
  });

  // Stuff to run on controller load
  $scope.itemsPerPage = 10;
  $scope.currentPage = 1;

  var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
  var numRows = $scope.itemsPerPage;
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

module.service('templateSrv', function() {
  this.staffScheduleModal = '/render/staff/staffScheduleModal';
  this.staffEditModal = '/render/staff/staffEditModal';
});

module.service('staffListSrv', function($http){
  var apiPath = '/admin/staff/';

  var self = this;

  this.getStaffList = function(row, numRows){
    return $http.get(apiPath + row + '/' + numRows)
      .then(function(response){
        self.staffList = response.data.Staffs;
        self.staffCount = response.data.StaffsCount[0].rowCount;
      });
  };

  this.saveStaff = function(staff, formToken) {
    var requestPath;
    if (!staff.id) {
      requestPath = apiPath + '/0';
    } else {
      requestPath = apiPath + '/' + staff.id;
    }
    var data = {};
    data.Widget = staff;
    data.FORM_SECURITY_TOKEN = formToken;
    return $http({
      method: 'POST',
      url: requestPath,
      data: data,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    });
  };
});
