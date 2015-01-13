
<h3>Add/Edit Event Invitee List</h3>
<form method="post">
    <table class="table">
        <tr>
            <td>Name:</td>
            <td><?php echo $form['name'];?></td>
        </tr>
        <tr>
            <td>Active:</td>
            <td><?php echo $form['isActive'];?></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?php echo $form['save'];?> 
                <?php echo $form['cancel'];?> 
            </td>
        </tr>
    </table>
</form>