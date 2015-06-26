

<div class="col-md-6">
    <div class="block">
        <div class="block-heading">
            <div class="main-text h2">
                Staff Employment Information
            </div>
            <div class="block-controls">
                <span class="icon icon-cross icon-size-medium block-control-remove" aria-hidden="true"></span>
                <span class="icon icon-arrow-down icon-size-medium block-control-collapse" aria-hidden="true"></span>
            </div>
        </div>
        <div class="block-content-outer">
            <div class="block-content-inner">


                <table class="table">

                    <tr>
                        <td>Company Email:</td>
                        <td><?php echo $form['email']; ?></td>
                    </tr>
                    <tr>
                        <td>Staff Type:</td>
                        <td><?php echo $form['StaffTypes_id']; ?></td>
                    </tr>
                    <tr>
                        <td>Department:</td>
                        <td><?php echo $form['Departments_id']; ?></td>
                    </tr>
                    <tr>
                        <td>Position:</td>
                        <td><?php echo $form['StaffPositions_id']; ?></td>
                    </tr>
                    <tr>
                        <td>Employee #</td>
                        <td><?php echo $form['employeeNumber']; ?></td>
                    </tr>
                    <tr>
                        <td>Hire Date</td>
                        <td><?php echo $form['hireDate']; ?></td>
                    </tr>
                    <tr>
                        <td>Departure Date:</td>
                        <td><?php echo $form['departureDate']; ?></td>
                    </tr>
                    <tr>
                        <td>Email Signature</td>
                        <td><?php echo $form['signature']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right"><?php echo $form['submit']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>




