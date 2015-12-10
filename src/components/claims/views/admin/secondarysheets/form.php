<?php pr(array_keys($SerializedAffectedAreaActions)); ?>
<div ng-controller="costCardEditCtrl">
    <div class="widget" >
        <div class="widget-content">

            <!--Tabs-->
            <uib-tabset>
                <!-- Summary Tab -->
                <uib-tab heading="<?php echo $this->getString('CLAIMS_FLOORS') ?>">
                    <div ng-if="loading" class="col-md-12 spacer">
                        <span class="spinner-loader"></span>
                    </div>
                    <div ng-if="!loading">


                        <h3>Extraction</h3>
                        <?php /*
                          $rows = $SerializedAffectedAreaActions['EXTRACTION'];
                          foreach ($rows[0] as $row) {
                          ?>
                          <div class="checkbox">
                          <label>
                          <input type="checkbox" name="SecondarySheet[1]" value="1" ng-model="secondarySheet.item_1" id="SecondarySheet_question" />
                          Carpet </label>
                          </div>
                          <?php } */ ?>


                        <h3>Carpet Cleaning</h3>
                        <?php /*
                          $rows = $SerializedAffectedAreaActions['CARPET_CLEANING'];
                          foreach ($rows[0] as $row) {
                          ?>
                          <div class="checkbox">
                          <label>
                          <input type="checkbox" name="SecondarySheet[1]" value="1" ng-model="secondarySheet.item_1" id="SecondarySheet_question" />
                          Carpet </label>
                          </div>
                          <?php } */ ?>

                        <h3>Flooring</h3>
                        <?php /*
                          $rows = $SerializedAffectedAreaActions['FLOORING'];
                          foreach ($rows[0] as $row) {
                          ?>
                          <div class="checkbox">
                          <label>
                          <input type="checkbox" name="SecondarySheet[1]" value="1" ng-model="secondarySheet.item_1" id="SecondarySheet_question" />
                          Carpet </label>
                          </div>
                          <?php } */ ?>

                </uib-tab>
                <!-- Laborers / Timesheets Tab -->
                <uib-tab heading="<?php echo $this->getString('CLAIMS_WALLS') ?>">

                    <h3>Drywall/Lathe &amp; Plaster</h3>

                    <?php
                    $rows = $SerializedAffectedAreaActions['DRYWALL'];

                    foreach ($rows[1] as $row) {
                        ?>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="SecondarySheet[1]" value="1" ng-model="secondarySheet.item_1" id="SecondarySheet_question" />
                                <?php echo $row['action']; ?> </label>
                        </div>
                    <?php } ?>
                    <h3>Insulation</h3>
                    <?php
                    $rows = $SerializedAffectedAreaActions['INSULATION'];

                    foreach ($rows[1] as $row) {
                        ?>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="SecondarySheet[1]" value="1" ng-model="secondarySheet.item_1" id="SecondarySheet_question" />
                                <?php echo $row['action']; ?> </label>
                        </div>
                    <?php } ?>
                </uib-tab>
                <!-- Equipment Tab -->
                <uib-tab heading="<?php echo $this->getString('CLAIMS_OTHERS') ?>">

                    <h3>Samples</h3>
                    <?php
                    $rows = $SerializedAffectedAreaActions['SAMPLES'];

                    foreach ($rows[1] as $row) {
                        ?>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="SecondarySheet[1]" value="1" ng-model="secondarySheet.item_1" id="SecondarySheet_question" />
                                <?php echo $row['action']; ?> </label>
                        </div>
                    <?php } ?>


                    <h3>Sub-Trades</h3>
                    <?php
                    $rows = $SerializedAffectedAreaActions['SUBTRADES'];

                    foreach ($rows[1] as $row) {
                        ?>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="SecondarySheet[1]" value="1" ng-model="secondarySheet.item_1" id="SecondarySheet_question" />
                                <?php echo $row['action']; ?> </label>
                        </div>
                    <?php } ?>

                    <h3>Equipment</h3>
                    <?php
                    $rows = $SerializedAffectedAreaActions['EQUIPMENT'];

                    foreach ($rows[1] as $row) {
                        ?>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="SecondarySheet[1]" value="1" ng-model="secondarySheet.item_1" id="SecondarySheet_question" />
                                <?php echo $row['action']; ?> </label>
                        </div>
                    <?php } ?>
                </uib-tab>


            </uib-tabset>
<!--<button class="btn-primary save-purchase-order" ng-click="saveAndClose()"><?php //echo $this->getString('CLAIMS_SAVE_AND_CLOSE');                                                                                               ?></button>-->
<!--<button class="btn-primary save-purchase-order" ng-click="saveAndNew()"><?php // echo $this->getString('ACCOUNTING_SAVE_AND_NEW');                                                                                               ?></button>-->
<!--<a href="../"><button class="btn-default save-purchase-order"><?php // echo $this->getString('ACCOUNTING_CANCEL');                                                                                               ?></button></a>-->
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<form></form><?php
pr($this->data);
?>
