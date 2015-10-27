

<script language="javascript">

    $(document).ready(function () {

        $('#previous-4').click(function () {
            //first, you need to save the data and get anew id number

            $('#left-feature-slider-edit3').toggle(true);
            $('#left-feature-slider-edit4').toggle(false);

        });

        $('#next-4').click(function () {
            //first, you need to save the data and get anew id number

            $('#left-feature-slider-edit4').toggle(false);
            $('#left-feature-slider-edit5').toggle(true);

        });

        $('#cancel-4').click(function () {
            $('#left-feature-slider-edit4').toggle(false);
        });
    });

</script>
<div class="panel panel-default">
    <div class="panel-heading">
        New Staff - Emergency Contact Info
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

    <style>
        #dialog-confirm {
            display: none;
        }
    </style>
    <div id="dialog-confirm" title="Add New Emergency Contact">
        <form method="post" id="econtact-form">
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

            <div class="slider-nav" id="previous-4">
                <span class="fa fa-arrow-circle-o-left"></span>
            </div>
            <div class="slider-nav cancel-slider" id="cancel-4">
                <span class="fa fa-times-circle-o"></span>
            </div>
            <div class="slider-nav" id="next-4">
                <span class="fa fa-arrow-circle-o-right"></span>
            </div>
    </div>