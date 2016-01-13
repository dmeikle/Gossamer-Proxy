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
    <button class="btn btn-primary" type="button" ng-click="ok()">OK</button>
    <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
</div>