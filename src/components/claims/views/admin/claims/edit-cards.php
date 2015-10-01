<div class="card">
  <div class="cardheader">
    <h1><?php echo $this->getString('CLAIMS_BUILDINGADDRESS'); ?></h1>
  </div>
  <table class="cardtable">
    <tbody>
      <tr>
        <td>
          <strong>
            <?php echo $this->getString('CLAIMS_BUILDINGNAME');?>
          </strong>
        </td>
        <td>
          {{claim.buildingName}}
        </td>
      </tr>
      <tr>
        <td>
          <strong>
            <?php echo $this->getString('CLAIMS_STRATANUM');?>
          </strong>
        </td>
        <td>
          {{claim.strataNum}}
        </td>
      </tr>
      <tr>
        <td>
          <strong>
            <?php echo $this->getString('CLAIMS_ADDRESS');?>
          </strong>
        </td>
        <td>
          <div>
            {{claim.address1}}
          </div>
          <div>
            {{claim.city}}
          </div>
          <div>
            {{claim.province}}
          </div>
          <div>
            {{claim.postalCode}}
          </div>
          <div>
            {{claim.country}}
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="clearfix"></div>
</div>

<div class="card">
  <div class="cardheader">
    <h1><?php echo $this->getString('CLAIMS_PHASE');?></h1>
  </div>
  <div class="cardleft">

    <div class="big">
      {{claim.currentPhase}}
    </div>
  </div>
  <div class="cardright">
    <p>{{claim.currentPhaseETA}} <?php echo $this->getString('CLAIMS_DAYSREMAIN');?></p>
  </div>
  <div class="clearfix"></div>
  <div class="cardfooter clearfix">
    <div class="pull-right">
      <a href="#"><?php echo $this->getString('MORE_INFO');?></a>
    </div>
  </div>
</div>

<div class="card">
  <div class="cardheader">
    <h1><?php echo $this->getString('REMINDERS');?></h1>
  </div>
  <ul>
    <li>Repeat <small><a class="pull-right" href="#"><?php echo $this->getString('DETAILS');?></a></small></li>
    <li>Over <small><a class="pull-right" href="#"><?php echo $this->getString('DETAILS');?></a></small></li>
    <li>Reminders <small><a class="pull-right" href="#"><?php echo $this->getString('DETAILS');?></a></small></li>
    <li>Here <small><a class="pull-right" href="#"><?php echo $this->getString('DETAILS');?></a></small></li>
  </ul>
</div>
