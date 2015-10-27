

<h2>Create/Edit Answer</h2>
<script language="javascript">

    $(document).ready(function () {
        $("#tabs").tabs();
        $('#cancel').click(function () {
            window.location = '/admin/surveys/answers/list/0/20';
        });
    });

</script>
<form method="post">
    <table class="table">

        <tr>
            <td>Answer:</td>
            <td>
                <div id="tabs">
                    <ul>
                        <?php foreach ($locales as $locale) { ?>
                            <li><a href="#<?php echo $locale['locale']; ?>"><?php echo $locale['languageName']; ?></a></li>
                        <?php } ?>
                    </ul>

                    <?php foreach ($form['answer']['locales'] as $key => $row) { ?>
                        <div id="<?php echo $key; ?>">
                            <?php echo $row; ?>
                        </div>
                    <?php } ?>

                </div>
            </td>
        </tr>
        <tr>
            <td>Active</td>
            <td>
                <?php echo $form['isActive']; ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <button class="btn btn-primary">Save</button>
                <input type="button" class="btn btn-primary" id="cancel" value="Cancel" >
            </td>
        </tr>

    </table>
</form>
