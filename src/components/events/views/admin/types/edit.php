
<?php echo $form['typeId'];?>
<?php echo $form['defaultLocale'];?>
    <table class="table" id="table1">
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
      </table>
