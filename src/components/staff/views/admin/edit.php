
<div id="staff-edit-slider" class="" >

    <input type="hidden" id="staffId" value="0" />
    <div id="tabs">
        <ul>

            <li><a href="#contact-info">Contact</a></li>
            <li><a href="#company-info">Company</a></li>
            <li><a href="#personal-info">Personal</a></li>
            <li><a href="#emergency-info">Emergency</a></li>
            <li><a href="#equipment-info">Equipment</a></li>
            <li style="float: right"> <?php echo $form['isActive']; ?>This employee is active</li>
        </ul>
        <form method="post" role="form" class="form-standard" id="staff-form" action="/admin/staff/ajaxsave/">
            <div id="contact-info">
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
                    <tr>
                        <td>Telephone:</td>
                        <td><?php echo $form['telephone']; ?></td>

                    </tr>
                    <tr>
                        <td>Mobile:</td>
                        <td><?php echo $form['mobile']; ?></td>

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
                        <td>Email Signature</td>
                        <td><?php echo $form['signature']; ?></td>
                    </tr>
                </table>
            </div>

            <div id="company-info">
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
                        <td>Image:</td>
                        <td><img src="" width="150" />
                            <?php echo $form['imageName']; ?>
                    </tr>
                </table>
            </div>


            <div id="personal-info">
                <table class="table">
                    <tr>
                        <td>Gender:</td>
                        <td><?php echo $form['gender']; ?></td>
                    </tr>
                    <tr>
                        <td>D.O.B.:</td>
                        <td><?php echo $form['dob']; ?></td>
                    </tr>
                    <tr>
                        <td>SIN:</td>
                        <td><?php echo $form['SIN']; ?></td>
                    </tr>
                    <tr>
                        <td>Alarm Password:</td>
                        <td><?php echo $form['alarmPassword']; ?></td>
                    </tr>
                </table>
            </div>
            <?php if ($id > 0) { ?>
                <div id="emergency-info">
                    <a href="#" class="add-emergency">add emergency contact</a>
                    <table class="table">
                        <tr>
                            <td>Name </td>
                            <td>Telephone</td>
                            <td>Mobile</td>
                            <td>Work Telephone</td>
                            <td>Relation</td>
                            <td>Email</td>
                            <td>Action
                        </tr>
                        <?php foreach ($emergencyContacts as $contact) { ?>
                            <tr>
                                <td><?php echo $contact['firstname']; ?> <?php echo $contact['lastname']; ?> </td>
                                <td><?php echo $contact['telephone']; ?></td>
                                <td><?php echo $contact['mobile']; ?></td>
                                <td><?php echo $contact['workTelephone']; ?></td>
                                <td><?php echo $contact['relation']; ?></td>
                                <td><?php echo $contact['email']; ?></td>
                                <td><input type="button" class="remove" data-id="<?php echo $contact['id']; ?>" value="remove" /></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            <?php } ?>
            <?php echo $form['cancel']; ?> <?php echo $form['submit']; ?>
        </form>
    </div>
    <style>
        #dialog-confirm {
            display: none;
        }
    </style>
    <div id="dialog-confirm" title="Add New Emergency Contact">
        <form method="post" id=econtact-form">
            <table class="table">
                <tr>
                    <td>Firstname:</td>
                    <td><?php echo $eform['firstname']; ?></td>
                </tr>
                <tr>
                    <td>Lastname:</td>
                    <td><?php echo $eform['lastname']; ?></td>
                </tr>
                <tr>
                    <td>Telephone:</td>
                    <td><?php echo $eform['telephone']; ?></td>
                </tr>
                <tr>
                    <td>Mobile:</td>
                    <td><?php echo $eform['mobile']; ?></td>
                </tr>
                <tr>
                    <td>Relation:</td>
                    <td><?php echo $eform['relation']; ?></td>
                </tr>
                <tr>
                    <td>Work Telephone:</td>
                    <td><?php echo $eform['workTelephone']; ?></td>
                </tr>

            </table>
        </form>
    </div>

</div>