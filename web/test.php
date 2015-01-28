<table>
  <tr>
    <td scope="col">left col</td>
    <td scope="col">
    
    <table class="table">
                    <tr>
                        <td colspan="2">
                            <div id="tabs">
                                <ul class="nav nav-tabs" role="tablist">
                                    <?php

                                    foreach($locales as $locale) {                    
                                        if($locale['isDefault']) {
                                            echo "<li class=\"active\"><a href=\"#{$locale['locale']}\" role=\"tab\" data-toggle=\"tab\">{$locale['languageName']}</a></li>\r\n";
                                        } else {
                                            echo "<li><a href=\"#{$locale['locale']}\" role=\"tab\" data-toggle=\"tab\">{$locale['languageName']}</a></li>\r\n";
                                        }
                                    }
                                    ?>
                                </ul>

                                <div class="tab-content">
                                    <?php 

                                    foreach($locales as $key => $locale) { ?>
                                    <div class="tab-pane<?php echo ($locale['isDefault']) ? ' active':'';?>" id="<?php echo $key;?>">
                                        <table width="100%">
                                            <tr>
                                                <td>Subject:</td>
                                                <td><?php echo $form['subject']['locales'][$key]; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Permalink:</td>
                                                <td>
                                                    <p class="btn bg-danger" style="display:none" class="page_name_message">Invalid characters in Page name. Please remove</p>
                                                    <p class="btn bg-danger" style="display:none" class="page_name_exists">Page name exists.</p>
                                                    <div class="form-group" class="page_name_container">
                                                         <?php echo $form['permalink']['locales'][$key]; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Comments:</td>
                                                <td><?php echo $form['comments']['locales'][$key]; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tags:</td>
                                                <td><?php echo $form['tags']['locales'][$key]; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor
                                        // instance, using default configuration.
                                        CKEDITOR.replace( 'Blog_locale_<?php echo $key; ?>_comments' );
                                    </script>
                                    <?php } ?>
                                </div>  
                            </div>
                        </td>
                    </tr>
                </table> 
                </td>
    <td scope="col">right col</td>
  </tr>
</table>
