
<!--- javascript start --->

    @/components/staff/staff.concat.js

<!--- javascript end --->

<div class="widget" ng-controller="staffListCtrl">
  <h1>Staff List</h1>
  <table class="table table-striped table-hover">
      <thead>
          <tr>
              <th><?php echo $this->getString('STAFF_NAME'); ?></th>
              <th><?php echo $this->getString('STAFF_TITLE'); ?></th>
              <th><?php echo $this->getString('STAFF_EXT'); ?></th>
              <th><?php echo $this->getString('STAFF_MOBILE'); ?></th>
              <th><?php echo $this->getString('STAFF_STATUS'); ?></th>
              <th><?php echo $this->getString('STAFF_LAST_LOGIN'); ?></th>
              <th>&nbsp;</th>
          </tr>
      </thead>
      <tbody>
          <tr ng-repeat="staff in staffList" >
              <td class="col-xs-2"><a href="mailto:{{staff.email}}">{{staff.lastname}}, {{staff.firstname}}</a></td>
              <td class="col-xs-2">{{staff.title}}</td>
              <td class="col-xs-1">{{staff.telephone}}</td>
              <td class="col-xs-2">{{staff.mobile}}</td>
              <td class="col-xs-1">{{staff.status}}</td>
              <td class="col-xs-2">{{staff.lastLogin}}</td>
              <td>
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a ng-click="openStaffScheduleModal(staff)">Schedule</a></li>
                    <li><a ng-click="openStaffEditModal(staff)">Edit</a></li>
                    <li><a href="#">Emergency Contacts</a></li>
                    <li><a href="#">Delete</a></li>
                  </ul>
                </div>
              </td>
          </tr>
      </tbody>
  </table>

  <pagination total-items="totalItems" ng-model="currentPage" max-size="itemsPerPage"
    class="pagination" boundary-links="true" rotate="false">
  </pagination>

  <form class="hidden"></form>
</div>
