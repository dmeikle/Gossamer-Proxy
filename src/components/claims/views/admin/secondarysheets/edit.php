
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
    <input type="hidden" id="Claims_id" name="SecondarySheet[Claims_id]" value="<?php echo $Claims_id; ?>" />
    <input type="hidden" id="ClaimsLocations_id" name="SecondarySheet[ClaimsLocations_id]" value="<?php echo $ClaimsLocations_id; ?>" />
    <input type="hidden" id="AffectedAreas_id" name="SecondarySheet[AffectedAreas_id]" value="<?php echo $AffectedAreas_id; ?>" />
    <input type="hidden" id="SecondarySheets_id" name="SecondarySheet[SecondarySheets_id]" value="<?php echo $SecondarySheets_id; ?>" />
    <div ng-controller="claimsSecondarySheetEditCtrl as ctrl">
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
        <input type="submit" value="<?php echo $this->getString('SAVE'); ?>" ng-click="saveSecondarySheet(secondarySheet)" />
    </div>
</form>
