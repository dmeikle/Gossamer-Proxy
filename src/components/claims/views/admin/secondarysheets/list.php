

<table class="table table-hover table-striped" ng-controller="SecondarySheetsCtrl">
    <thead>
    <th>
        date
    </th>
    <th>
        unit #
    </th>
    <th>
        staff
    </th>

</thead>
<tr ng-repeat="item in itemList">
    <td>
        {{item.lastModified}}
    </td>
    <td>
        {{item.unitNumber}}
    </td>
    <td>
        {{item.firstname}} {{item.lastname}}
    </td>
</tr>
</table>