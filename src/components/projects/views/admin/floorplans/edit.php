
<h3>Add/Edit FloorPlan</h3>
<form method="post" role="form" enctype="multipart/form-data">
    <table class="table">
        <tr>
            <td>FloorPlan Name:</td>
            <td><?php echo $form['name']; ?></td>
        </tr>
        <tr>
            <td>FloorPlan:</td>
            <td>
                <?php echo $form['floorPlan']; ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><?php echo $form['submit']; ?></td>
        </tr>
    </table>
</form>