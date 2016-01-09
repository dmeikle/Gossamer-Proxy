
<table class="table">
    <tr>
        <td><?php echo $this->getString('CLAIMS_DATE'); ?></td>
        <td> </td>
        <td><?php echo $this->getString('CLAIMS_TECHNICIANS_ATTENDED'); ?></td>
        <td> </td>
    </tr>
    <tr>
        <td><?php echo $this->getString('CLAIMS_UNIT_NO'); ?></td>
        <td> </td>
        <td><?php echo $this->getString('CLAIMS_ADDRESS'); ?></td>
        <td> </td>
    </tr>
    <tr>
        <td><?php echo $this->getString('CLAIMS_ROOM'); ?></td>
        <td> </td>
        <td><?php echo $this->getString('CLAIMS_CITY'); ?></td>
        <td> </td>
    </tr>
</table>
<form class="form-inline">

    <div ng-controller="claimsSecondarySheetEditCtrl
                as
                ctrl">
        <input type="hidden" ng-model="secondarySheet.Claims_id" id="Claims_id" name="SecondarySheet[Claims_id]" value="<?php echo $Claims_id; ?>" />
        <input type="hidden" ng-model="secondarySheet.ClaimsLocations_id" id="ClaimsLocations_id" name="SecondarySheet[ClaimsLocations_id]" value="<?php echo $ClaimsLocations_id; ?>" />
        <input type="hidden" ng-model="secondarySheet.AffectedAreas_id" id="AffectedAreas_id" name="SecondarySheet[AffectedAreas_id]" value="<?php echo $AffectedAreas_id; ?>" />
        <input type="hidden" ng-model="secondarySheet.SecondarySheets_id" id="SecondarySheets_id" name="SecondarySheet[SecondarySheets_id]" value="<?php echo $SecondarySheets_id; ?>" />
        <?php
        $category = '';
        foreach ($Actions as $category => $group) {
            echo '<h3>' . $this->getString('CLAIMS_' . $category) . '</h3>';
            foreach ($group as $questionList) {
                $columnCount = count($questionList);
                $columnSize = intval(12 / $columnCount);
                foreach ($questionList as $question) {
                    if ($question['questionType'] == 'check') {
                        echo '<div class="form-group col-md-' . $columnSize . '"><label>' . current($question['html']) .
                        $question['action'] . ' ' . '</label></div>';
                    } else {
                        echo '<div class="form-group col-md-' . $columnSize . '"><label class="col-md-12">' .
                        $question['action'] . ' ' . current($question['html']) . ' ' . $question['description'] . '</label></div>';
                    }
                }
                echo '<div class="clearfix"></div>';
            }
            echo '<div class="clearfix"></div>';
        }
        ?>

        <input type="submit" value="<?php echo $this->getString('SAVE'); ?>" ng-click="ctrl.saveSecondarySheet(ctrl.secondarySheet)" />
        <input type="button" value="Set Complete Items" ng-click="openResultsModal" />
        <div id="editResultsModal">modal here
            <?php
            foreach ($group as $questionList) {
                foreach ($questionList as $question) {
                    echo '<div class="col-md-6">' . $question['action'] . '</div><div class="col-md-6">' . current($question['updateHtml']) . '</div>';
                }
            }
            ?>
            <div ng-repeat="item in ctrl.secondarySheetResults track by $index" ng-show="item.value || item.isSelected">

                <div class="form-group col-md-6">{{item.action}}</div>
                <div class="form-group col-md-6"><input type="checkbox" ng-model="item.isDone" ng-true-value="1" /> Completed</div>
            </div>
            <input type="submit" value="<?php echo $this->getString('SAVE'); ?>" ng-click="ctrl.saveSecondarySheetResults(ctrl.secondarySheetResults)" />
        </div>
    </div>
</form>


