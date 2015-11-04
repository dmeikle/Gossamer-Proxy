<div class="card" ng-controller="inventoryEquipmentEditCtrl">
    <div class="cardheader">
        <h1><?php echo $this->getString('INVENTORY_TRANSFER_HISTORY') ?></h1>
    </div>
    <div ng-if="loading">
        <div class="spinner-loader"></div>
    </div>
    <table ng-if="!loading" class="table cardtable">
        <tr ng-repeat="item in transferHistory">
            <td>
                {{item.transferDate}}
            </td>
            <td>
                {{item.currentLocation}}
            </td>
            <td>
                {{item.firstname}} {{item.lastname}}
            </td>
        </tr>
    </table>
    <div class="cardfooter clearfix">
        <div class="pull-right"><a href=""><?php echo $this->getString('MORE_INFO') ?></a></div>
    </div>
</div>
