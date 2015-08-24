<div class="modal-header" ng-switch="staff.id">
  <h1 ng-switch-when="undefined" class="modal-title">Add New Staff Member</h1>
  <h1 class="modal-title" ng-switch-default>{{staff.firstname}} {{staff.lastname}}</h1>
  <div class="clearfix"></div>
</div>
