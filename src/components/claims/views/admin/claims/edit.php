<?php pr($form) ?>
<div class="widget">
  <div class="widgetheader">
    <h1><?php echo $this->getString('CLAIMS_AFFECTEDUNITS'); ?></h1>
  </div>
  TBD WHEN LOCATIONS ARE READY
</div>

<div class="widget">
  <div class="widgetheader">
    <h1><?php echo $this->getString('CLAIMS_CLIENTLIST') ?></h1>
  </div>
  TBD WHEN CLIENTS ARE READY
</div>

<div class="widget">
  <div class="widgetheader">
    <h1><?php echo $this->getString('CLAIMS_CLIENTMESSAGES') ?></h1>
  </div>
  TBD WHEN MESSAGING IS READY
</div>

<div class="widget">
  <div class="widgetheader">
    <h1><?php echo $this->getString('CLAIMS_CUSTOMERMESSAGES') ?></h1>
  </div>
  TBD WHEN MESSAGING IS READY
</div>

<div class="widget" ng-controller='claimsEditCtrl'>
  <ul class="widgettabs">
    <li role="presentation" ng-class="{active:selectedTab === 'comments'}">
      <a href="" data-tabname="comments" ng-click="selectTab($event)">
        <?php echo $this->getString('COMMENTS') ?>
      </a>
    </li>
    <li role="presentation" ng-class="{active:selectedTab === 'worklog'}">
      <a href="" data-tabname="worklog" ng-click="selectTab($event)">
        <?php echo $this->getString('WORKLOG') ?>
      </a>
    </li>
    <li role="presentation" ng-class="{active:selectedTab === 'history'}">
      <a href="" data-tabname="history" ng-click="selectTab($event)">
        <?php echo $this->getString('HISTORY') ?>
      </a>
    </li>
  </ul>
  <div ng-if="selectedTab === 'comments'">
    <p>This is the comments tab</p>
    <p>Needs a directive to go get comments</p>
  </div>
  <div ng-if="selectedTab === 'worklog'">
    This is the worklog tab
    <p>needs a directive to go get worklog</p>
  </div>
  <div ng-if="selectedTab === 'history'">
    This is the history tab
    <p>needs a directive to go get history</p>
  </div>
</div>
