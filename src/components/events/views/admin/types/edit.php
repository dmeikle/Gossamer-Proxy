


<h2>Add/Edit Event</h2>
<script language="javascript">

$(document).ready(function() {
    $( "#tabs" ).tabs(); 
});

</script>
<form method="post">
    <table>
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
          <?php echo $form['save']; ?>
          <?php echo $form['cancel']; ?>
          </td>
        </tr>
      </table>
</form>