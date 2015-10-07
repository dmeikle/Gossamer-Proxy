

<?php
//sample code
foreach($StaffRoles as $role) {?>
<input type="checkbox" value="<?php echo $role['id'];?>" name="role[]"/> <?php echo $role['role'];?><br>
<?php } ?>

