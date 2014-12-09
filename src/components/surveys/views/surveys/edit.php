


<h2>Create/Edit Survey</h2>
<script language="javascript">

$(document).ready(function() {
    $( "#tabs" ).tabs(); 
});

</script>
<form role="form" method="post">
<table class="table">       
       <tr>
         <td>Name</td>
         <td>
         <div id="tabs">
            <ul>
                <?php
                foreach($locales as $locale) {?>
                    <li><a href="#<?php echo $locale['locale'];?>"><?php echo $locale['languageName'];?></a></li>
                <?php } ?>
            </ul>
            
            <?php foreach($form['name']['locales'] as $key => $row) { ?>
                <div id="<?php echo $key; ?>">
                    <?php echo $row; ?>
                </div>
            <?php } ?>
            
          </div>
         </td>
       </tr>
       <tr>
         <td>Department</td>
         <td><?php echo $form['SurveyCategories_id']; ?></td>
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
             <button class="btn btn-primary" id="cancel">Cancel</button> 
         </td>
       </tr>
     </table>
</form>    

