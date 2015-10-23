<!--- javascript start --->

@components/staff/includes/js/admin-staff-list-ng.js

<!--- javascript end --->

<div class="col-md-6">
    <div class="block">
        <div class="block-heading">
            <div class="main-text h2">
                Staff Personal Information
            </div>
            <div class="block-controls">
                <span class="icon icon-cross icon-size-medium block-control-remove" aria-hidden="true"></span>
                <span class="icon icon-arrow-down icon-size-medium block-control-collapse" aria-hidden="true"></span>
            </div>
        </div>
        <div class="block-content-outer">
            <div class="block-content-inner">


                <table class="table" >

                    <tr>
                        <td>Firstname:</td>
                        <td><?php echo $form['firstname']; ?></td>
                    </tr>
                    <tr>
                    <tr>
                        <td>Lastname:</td>
                        <td><?php echo $form['lastname']; ?></td>
                    </tr>
<!--                    <tr>
                        <td>Gender:</td>
                        <td><?php //echo $form['gender'];         ?></td>
                    </tr>-->
                    <tr>
                        <td>Telephone:</td>
                        <td><?php echo $form['personalTelephone']; ?></td>

                    </tr>
                    <tr>
                        <td>Mobile:</td>
                        <td><?php echo $form['personalMobile']; ?></td>

                    </tr>
                    <tr>
                        <td>Personal Email:</td>
                        <td><?php echo $form['personalEmail']; ?></td>

                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td><?php echo $form['address1']; ?> <?php echo $form['address2']; ?></td>

                    </tr>
                    <tr>
                        <td>City:</td>
                        <td><?php echo $form['city']; ?></td>
                    </tr>
                    <tr>
                        <td>Province:</td>
                        <td><?php echo $form['Provinces_id']; ?></td>
                    </tr>
                    <tr>
                        <td>Postal Code:</td>
                        <td><?php echo $form['postalCode']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right"><?php echo $form['submit']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>




