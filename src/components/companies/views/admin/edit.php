
<script language="javascript">

$(function() {
   $('#Company_cancel').click(function(e) {
      $('#left-feature-slider-edit').toggle(false);
   });
   
   $('#Company_save').click(function(e) {
       e.stopPropagation();
       var id = $('#Company_companyId').val();
      
       $.ajax({
            url: '/admin/companies/' + id,
            type: "post",
            data: $('#company-form').serialize()
        });
       
      $('#left-feature-slider-edit').toggle(false);
   });
   
});

</script>


<form role="form" class="form-standard" method="post" id="company-form">
    <?php echo $form['companyId'];?>
    <table class="table">
      <tr>
          <td>Name:</td>
          <td><?php echo $form['name'];?></td>
      </tr>
      <tr>
        <td>Type:</td>
        <td>
            <select class="form-control" name="company[CompanyTypes_id]">
                <option>load company types</option>
            </select>
        </td>
      </tr>
      <tr>
        <td>Address:</td>
        <td><?php echo $form['address1'];?>
        <?php echo $form['address2'];?></td>
      </tr>
      <tr>
        <td>City:</td>
        <td><?php echo $form['city'];?></td>
      </tr>
      <tr>
        <td>Province:</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Postal Code:</td>
        <td><?php echo $form['postalCode'];?></td>
      </tr>
      <tr>
        <td>Telephone:</td>
        <td><?php echo $form['telephone'];?></td>
      </tr>
      <tr>
        <td>Fax:</td>
        <td><?php echo $form['fax'];?></td>
      </tr>
      <tr>
        <td>URL:</td>
        <td><?php echo $form['url'];?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
        	<?php echo $form['cancel'];?>  <?php echo $form['save'];?>
        </td>
      </tr>
    </table>
</form>
