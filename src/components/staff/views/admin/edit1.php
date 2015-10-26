
<script language="javascript">

    $(document).ready(function () {


        $('#next-1').click(function () {
            //first, you need to save the data and get anew id number

            $('#left-feature-slider-edit1').toggle(false);
            $('#left-feature-slider-edit2').toggle(true);

        });

        $('#cancel-1').click(function () {
            $('#left-feature-slider-edit1').toggle(false);
        });
    });

</script>
<div class="panel panel-default">
    <div class="panel-heading">
        New Staff - Contact Info
    </div>
    <input type="hidden" id="staffId" value="0" />

    <li style="float: right"> <?php echo $form['isActive']; ?>This employee is active</li>

    <form method="post" role="form" class="form-standard" id="staff-form1" action="/admin/staff/ajaxsave/">

        <table >
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="2" rowspan="4"><img src="" width="150" /></td>
            </tr>
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
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Mobile:</td>
                <td><?php echo $form['mobile']; ?></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Personal Email:</td>
                <td><?php echo $form['personalEmail']; ?></td>
                <td colspan="2">Email Signature</td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><?php echo $form['address2']; ?><?php echo $form['address1']; ?></td>
                <td colspan="2" rowspan="4" valign="top"><?php echo $form['signature']; ?></td>
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
        </table>
</div>
</form>


<div class="slider-nav cancel-slider" id="cancel-1">
    <span class="fa fa-times-circle-o"></span>
</div>
<div class="slider-nav" id="next-1">
    <span class="fa fa-arrow-circle-o-right"></span>
</div>
</div>