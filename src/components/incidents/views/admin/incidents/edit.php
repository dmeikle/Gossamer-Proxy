

<script language="javascript">

$(document).ready(function() {
    $( "#tabs" ).tabs(); 
});

</script>



<h3>Create/Edit Incident Type</h3>
<form method="post" role="form">
    <table class="table">
      <tr>
        <td>Type:</th>
        <td>
            <div id="tabs">
               <ul>
                    <?php
                    foreach($locales as $locale) {?>
                        <li><a href="#<?php echo $locale['locale'];?>"><?php echo $locale['languageName'];?></a></li>
                    <?php } ?>
                </ul>

                <?php foreach($form['incidentType']['locales'] as $key => $row) { ?>
                    <div id="<?php echo $key; ?>">
                        <?php echo $row; ?>
                    </div>
                <?php } ?>        
            </div>
        </td>
      </tr>
      <tr>
        <td>Score:</td>
        <td><?php echo $form['score']; ?></td>
      </tr>
      <tr>
        <td>Sections:</td>
        <td><?php echo $form['Sections_id']; ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><?php echo $form['submit']; ?>
         <?php echo $form['cancel']; ?>
        </td>
      </tr>
    </table>
</form>