

<h2>Work Performed</h2>
<script language="javascript">

    $(document).ready(function () {
        $("#tabs").tabs();
    });

</script>
<form role="form" method="post">
    <table class="table">
        <tr>
            <td>Name</td>
            <td>
                <div id="tabs">
                    <ul>

                        <?php foreach ($locales as $locale) { ?>
                            <li><a href="#<?php echo $locale['locale']; ?>"><?php echo $locale['languageName']; ?></a></li>
                        <?php } ?>

                    </ul>

                    <?php foreach ($form['action']['locales'] as $key => $row) { ?>
                        <div id="<?php echo $key; ?>">
                            <?php echo $row; ?>
                        </div>
                    <?php } ?>

                </div>
            </td>
        </tr>
        <tr>
            <td>Code</td>
            <td><?php echo $form['code']; ?></td>
        </tr>
        <tr>
            <td>Department</td>
            <td><?php echo $form['Departments_id']; ?></td>
        </tr>
        <tr>
            <td>Phase</td>
            <td><?php echo $form['ClaimPhases_id']; ?></td>
        </tr>
        <tr>
            <td>Layer</td>
            <td>

                <?php echo $form['layer']; ?>
                <span class="alert-info">example: <br />1 - Baseboard<br />2 - Drywall<br />3 - Insulation</span>

            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <button class="btn btn-primary">Save</button>
                <button class="btn btn-primary" id="cancel">Cancel</button>
            </td>
        </tr>
    </table>
</form>