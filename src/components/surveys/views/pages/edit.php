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