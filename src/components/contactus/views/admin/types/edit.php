
<script language="javascript">

$(document).ready(function() {
    $( "#tabs" ).tabs(); 
});

</script>


<form role="form" class="form-standard" method="post">
    <table class="table">
      <tr>
          <td>Type:</td>
          <td>
          <div id="tabs">
            <ul>

                <?php
                foreach($locales as $locale) {?>
                    <li><a href="#<?php echo $locale['locale'];?>"><?php echo $locale['languageName'];?></a></li>
                <?php } ?>

            </ul>
            
            <?php foreach($form['type']['locales'] as $key => $row) { ?>
                <div id="<?php echo $key; ?>">
                    <?php echo $row; ?>
                </div>
            <?php } ?>
            
          </div>
          </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
        	<?php echo $form['submit']; ?>        
        </td>
      </tr>
    </table>
</form>
