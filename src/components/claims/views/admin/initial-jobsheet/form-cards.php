<div class="card" ng-controller="initialJobsheetCtrl">
    <div class="cardheader">
        <h1><?php echo $this->getString('CLAIMS_JOBSHEET') ?></h1>
    </div>
    <div ng-if="paLoading"><span class="spinner-loader"></span></div>
    <table ng-if="!paLoading" class="cardtable">
        <tbody>
            <tr>
                <td><strong><?php echo $this->getString('CLAIMS_JOBSHEET_JOBNUM') ?></strong></td>
                <td>{{claim.jobNumber}}</td>
            </tr>
            <tr>
                <td><strong><?php echo $this->getString('CLAIMS_JOBSHEET_ADDRESS') ?></strong></td>
                <td>
                    <div>{{projectAddress.address1}}</div>
                    <div>{{projectAddress.address2}}</div>
                    <div>{{projectAddress.neighborhood}}</div>
                    <div>{{projectAddress.city}}</div>
                    <div>{{projectAddress.postalCode}}</div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
