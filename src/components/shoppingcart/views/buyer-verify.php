
<div class="panel panel-default">
    <div class="panel-heading">Purchaser Information</div>
    <div class="panel-body">
        <table class="table">
            <tr>
                <td>
                    <strong>Billing Information</strong><br>
                    <?php
                    echo $client['firstname'] . ' ' . $client['lastname'] . '<br>';
                    echo $client['address1'] . '<br>';

                    if (strlen($client['address2']) > 0) {
                        echo $client['address2'] . '<br>';
                    }
                    echo $client['city'] . '<br>';
                    echo $client['state'] . ', ';
                    echo $client['zip'] . '<br>';
                    echo $client['country'] . '<br>';
                    if (strlen($client['email']) > 0) {
                        echo $client['email'] . '<br>';
                    }
                    if (strlen($client['company']) > 0) {
                        echo $client['company'] . '<br>';
                    }
                    if (strlen($client['telephone']) > 0) {
                        echo $client['telephone'] . '<br>';
                    }
                    ?>
                </td>
                <td>
                    <strong>Shipping Information (if different)</strong><br>
                    <?php
                    echo $client['shipFirstname'] . ' ' . $client['shipLastname'] . '<br>';
                    echo $client['shipAddress1'] . '<br>';
                    if (strlen($client['shipAddress2']) > 0) {
                        echo $client['shipAddress2'] . '<br>';
                    }
                    echo $client['shipCity'] . '<br>';
                    echo $client['shipState'] . ', ';
                    echo $client['shipZip'] . '<br>';
                    echo $client['shipCountry'] . '<br>';

                    if (strlen($client['shipEmail']) > 0) {
                        echo $client['shipEmail'] . '<br>';
                    }
                    if (strlen($client['shipCompany']) > 0) {
                        echo $client['shipCompany'] . '<br>';
                    }
                    if (strlen($client['shipTelephone']) > 0) {
                        echo $client['shipTelephone'] . '<br>';
                    }
                    ?>
                </td>
            </tr>

        </table>
    </div>

</div>
