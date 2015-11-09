<div class="modal-header">
    <h1>
        <span ng-if="vendor">{{vendor.company}} - {{vendorLocation.city}} </span>
        <?php echo $this->getString('VENDORS_PURCHASE_ORDERS') ?>
    </h1>
</div>
<div class="modal-body">
    <table class="table table-striped">
        <thead>
            <th><?php echo $this->getString('VENDORS_PURCHASE_ORDERS') ?></th>
            <th><?php echo $this->getString('DATE') ?></th>
            <th><?php echo $this->getString('VENDORS_TOTAL') ?></th>
            <th><?php echo $this->getString('STATUS') ?></th>
            <th class="cog-col"></th>
        </thead>
        <tr ng-repeat="item in purchaseOrdersList" ng-class="getClass(item)">
            <td>{{item.poNumber}}</td>
            <td>{{item.creationDate}}</td>
            <td>{{item.total| currency}}</td>
            <td>{{item.status}}</td>
            <td><a href="/admin/accounting/pos/{{item.id}}">view</a></td>
        </tr>
    </table>
    <uib-pagination class="pull-left" total-items="totalItems" ng-model="currentPage" items-per-page="itemsPerPage"
        class="pagination" boundary-links="true" rotate="false">
    </uib-pagination>
    <div class="clearfix"></div>
</div>
<div class="modal-footer">
    <div class="pull-right">
        <button ng-click="close()" class="btn-default">
            <?php echo $this->getString('CLOSE') ?>
        </button>
    </div>
</div>
