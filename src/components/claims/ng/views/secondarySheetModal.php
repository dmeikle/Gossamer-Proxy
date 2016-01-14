<div class="modal-header">
    <h3 class="modal-title">Set Complete Items</h3>
</div>
<div class="modal-body">
    <?php
    foreach ($Actions as $category => $group) {
        foreach ($group as $questionList) {
            foreach ($questionList as $question) {
                if (is_null($question['updateHtml'])) {
                    continue;
                }
//                    echo '<div class="col-md-6">' . $question['action'] . '</div><div class="col-md-6">' . current($question['updateHtml']) . '</div>';
                echo '<div class="col-md-12"><label>' . current($question['updateHtml']) . $question['action'] . '</label></div>';
            }
        }
    }
    ?>
    <div class="clearfix"></div>
</div>
<div class="modal-footer">
    <div class="btn-group">
        <button ng-click="modal.cancel()"><?php echo $this->getString('CLAIMS_CANCEL'); ?></button>
        <button class="primary" ng-click="modal.saveSecondarySheetResults(modal.secondarySheetResults)"><?php echo $this->getString('SAVE'); ?></button>
    </div>
</div>