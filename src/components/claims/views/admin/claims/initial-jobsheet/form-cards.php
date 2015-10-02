<div class="card">
  <div class="cardheader">
    <h1><?php echo $this->getString('CLAIMS_JOBSHEET') ?></h1>
  </div>
  <table class="cardtable">
    <tbody>
      <tr>
        <td><strong><?php echo $this->getString('CLAIMS_JOBSHEET_JOBNUM') ?></strong></td>
        <td>{{claim.jobNumber}}</td>
      </tr>
      <tr>
        <td><strong><?php echo $this->getString('CLAIMS_JOBSHEET_ADDRESS') ?></strong></td>
        <td>
          <div>{{claim.address1}}</div>
          <div>{{claim.address2}}</div>
          <div>{{claim.neighborhood}}</div>
          <div>{{claim.city}}</div>
          <div>{{claim.postalCode}}</div>
        </td>
      </tr>
    </tbody>
  </table>
</div>
