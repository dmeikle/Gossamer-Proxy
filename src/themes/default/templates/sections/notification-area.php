<div class="notification-area" role="alert" id="notificationArea" ng-controller="toastsCtrl">
  <div ng-repeat="alert in alerts.notificationArea" class="alert clearfix"
    ng-class="{'alert-success':alert.type === 'success', 'alert-info':alert.type === 'info',
            'alert-warning':alert.type === 'warning', 'alert-danger':alert.type === 'danger',
            'alert-closed':!alert.message}">
    <p class="pull-left">{{alert.message}}</p>
    <button class="pull-right close" ng-click="dismissAlert(alert)"><span class="glyphicon glyphicon-remove"></span></button>
  </div>
</div>