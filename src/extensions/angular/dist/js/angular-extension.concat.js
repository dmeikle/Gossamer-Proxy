var module = angular.module('phoenixRestorations', [
  // 'accounting',
  // 'staff',
  // 'widgets'
]);

module.controller('toastsCtrl', function($scope, toastsSrv) {

  $scope.alerts = toastsSrv.alerts;

  $scope.dismissAlert = toastsSrv.dismissAlert;

});

module.service('toastsSrv', function() {

  var self = this;

  this.alerts = {};

  this.newAlert = function(alert) { //Expects {domNodeId: <value>, message: <value>, type: <error, info, warning, success>}
    if (!self.alerts[alert.domNodeId]) {
      self.alerts[alert.domNodeId] = [];
    }
    if (alert.hasOwnProperty('domNodeId') && alert.hasOwnProperty('message')&& alert.hasOwnProperty('type')) {
      self.alerts[alert.domNodeId].push(alert);
    }
  };

  this.dismissAlert = function(alert) {
    self.alerts[alert.domNodeId].splice(self.alerts[alert.domNodeId].indexOf(alert), 1);
  };
});
