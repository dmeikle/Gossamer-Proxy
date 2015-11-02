<script language="javascript">
    $(document).ready(function () {

        $('.selectable-rows tr').click(function () {

            if ($(this).data('type') == 'subcontractor') {
                $(this).next().slideToggle();
            }
        });

        $('.view').click(function (e) {
            e.preventDefault();
            window.location = '/admin/subcontractors/' + $(this).data('id');
        })

        $('.viewContacts').click(function (e) {
            e.preventDefault();
            window.location = '/admin/subcontractors/contacts/' + $(this).data('id');
        })



    });
</script>


<h2 class="form-signin-heading">Subcontractors List</h2>

<table class="table table-striped table-hover selectable-rows">
    <tr>
        <th width="7%">Name</th>
        <th width="11%" align="center">Email</th>
        <th width="4%" align="center">Url</th>
        <th width="4%" align="center">Telephone</th>
        <th width="4%" align="center">Address</th>
        <th width="4%" align="center">City</th>
        <th width="4%" align="center">Postal Code</th>
        <th width="4%" align="center">Type</th>
        <th width="4%" align="center">Rating</th>
        <th width="4%" align="center">Is Preferred</th>
        <th width="14%" align="center">Action</th>
    </tr>
    <?php
    foreach ($Subcontractors as $contractor) {
        ?>
        <tr title="click to view current jobs" data-type="subcontractor" valign="top" data-id="<?php echo $contractor['id']; ?>">
            <td><?php echo $contractor['companyName']; ?></td>
            <td><?php echo $contractor['email']; ?></td>
            <td><?php echo $contractor['url']; ?></td>
            <td><?php echo $contractor['telephone']; ?></td>
            <td><?php echo $contractor['address1']; ?></td>
            <td><?php echo $contractor['city']; ?></td>
            <td><?php echo $contractor['postalCode']; ?></td>
            <td><?php echo $SubcontractorTypes[$contractor['SubcontractorTypes_id']]; ?></td>
            <td><?php echo $contractor['rating']; ?></td>
            <td><?php echo $contractor['isPreferred']; ?></td>
            <td><button class="view" data-id="<?php echo $contractor['id']; ?>">View</button>
                <button class="viewContacts" data-id="<?php echo $contractor['id']; ?>">View Contacts</button>
                <button class="delete">Delete</button></td>
        </tr>
        <tr style="display:none">
            <td></td>
            <td colspan="10">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Claim</th>
                            <th>Address</th>
                            <th>Start Date</th>
                            <th>Expected Completion</th>
                            <th>Actual Completion</th>
                            <th>Notes</th>
                            <th>Contact</td>
                        </tr>
                    </thead>
                    <tr>
                        <td>MV-14JS123</td>
                        <td>1234 University Place, Surrey, BC</td>
                        <td>2014-07-10</td>
                        <td>2014-07-20</td>
                        <td></td>
                        <td>this is a test of the notes system.</td>
                        <td>Dolf Lundgren - 604-123-1234</td>
                    </tr>
                    <tr>
                        <td>MV-14JS123</td>
                        <td>1234 University Place, Surrey, BC</td>
                        <td>2014-07-10</td>
                        <td>2014-07-20</td>
                        <td></td>
                        <td>notes</td>
                        <td>Dolf Lundgren - 604-123-1234</td>
                    </tr>
                    <tr>
                        <td>MV-14JS123</td>
                        <td>1234 University Place, Surrey, BC</td>
                        <td>2014-07-10</td>
                        <td>2014-07-20</td>
                        <td></td>
                        <td>notes</td>
                        <td>Dolf Lundgren - 604-123-1234</td>
                    </tr>
                </table>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
&lt;&lt; 1 2 3 4 5 &gt;&gt;

