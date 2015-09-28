

<script src="https://cdn.ckeditor.com/4.4.5.1/standard/ckeditor.js"></script>
<script language="javascript">

$(document).ready(function() {
    $( "#tabs" ).tabs(); 
});

</script>
<h3>Survey Page</h3>
<form method="post">
<table class="table">
    <tr>
        <td>Name:</td>
        <td><?php echo $form['name'];?></td>
    </tr>
    <tr>
        <td>Title:</td>
        <td>
        <div id="tabs">
            <ul>

                <?php
                foreach($locales as $locale) {?>
                    <li><a href="#<?php echo $locale['locale'];?>"><?php echo $locale['languageName'];?></a></li>
                <?php } ?>

            </ul>
            
            <?php foreach($form['title']['locales'] as $key => $row) { ?>
                <div id="<?php echo $key; ?>">
                    <?php echo $row; ?>
                     Description:
                    <?php echo $form['description']['locales'][$key];?>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                               CKEDITOR.replace( 'SurveyPage_locale_<?php echo $key; ?>_description' );
                            </script>   
                </div>
            <?php } ?>
            
          </div>
        </td>
    </tr>
    <tr>
        <td>CSS Class:</td>
        <td><?php echo $form['cssClass'];?></td>
    </tr>
    <tr>
        <td>Active:</td>
        <td><?php echo $form['isActive'];?></td>
    </tr>
    <tr>
        <td> </td>
        <td><?php echo $form['save'];?> <?php echo $form['cancel'];?></td>
    </tr>
</table>
</form>