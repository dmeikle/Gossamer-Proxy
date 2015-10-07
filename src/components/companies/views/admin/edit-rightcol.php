<div class="cardtable" ng-controller="companyClientsListCtrl">
    <div ng-repeat="client in clientsList" class="sidePanelRow">
          <div class="name">{{ client.jobNumber }}</div>
          <div class="dateReceived"><?php echo $this->getString('CLAIMS_DATE_RECEIVED')?> {{ claim.dateReceived }}</div>
          <div class="claimType">{{ client.icon }}  {{ client.typeOfClaim }} {{ client.ClaimTypes_other }}</div> 
          <div class="deductable"><?php echo $this->getString('CLAIMS_DEDUCTABLE')?> {{ client.deductable }}</div>
          <div class="reason"><?php echo $this->getString('CLAIMS_REASON')?> <br />{{ client.reason }}</div>
          <div class="unassignedJobNumber">{{ client.unassignedJobNumber }}</div>
          <div class="projectManager">{{ client.firstname }} {{ claim.lastname }}</div>    
          <div class="claimStatus">{{ client.status }}</div>          
      </div>
</div>