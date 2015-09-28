
<!--- javascript start --->
@components/events/includes/js/jquery.ptTimeSelect.js

<!--- javascript end --->

<!--- css start --->
@components/events/includes/css/jquery.ptTimeSelect.css

<!--- css end --->



<h2>Add/Edit Event</h2>
<script src="https://cdn.ckeditor.com/4.4.5.1/standard/ckeditor.js"></script>

<script language="javascript">

$(document).ready(function() {
    $( "#tabs" ).tabs();
    $( "#Event_eventDate" ).datepicker({dateFormat: "yy-mm-dd", minDate: 0, maxDate: "+12M +10D" });
    $( "#Event_fromTime" ).ptTimeSelect();
    $( "#Event_toTime" ).ptTimeSelect();
    
    
    $(".contactSettings").click(function() {
        document.location = '/admin/events/settings/' + $(this).data('id');
    });
});

</script>
<form method="post">
    <table>
        <tr>
          <td colspan="2">
              
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
                                        <td>Name:</td>
                                        <td><?php echo $form['name']['locales'][$key]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Description:</td>
                                        <td><?php echo $form['description']['locales'][$key]; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'Event_locale_<?php echo $key; ?>_description' );
                            </script>
                            <?php } ?>
                        </div>  
                          </div>
                       
                      </td>
                  </tr>
                  
              </table>
            </div>          
          </td>
        </tr>
        
        <tr>
          <td>Event Type:</td>
          <td><?php echo $form['EventTypes_id']; ?></td>
        </tr>
        <tr>
          <td>Event Date:</td>
          <td><?php echo $form['eventDate']; ?></td>
        </tr>
        <tr>
          <td>From Time:</td>
          <td><?php echo $form['fromTime']; ?></td>
        </tr>
        <tr>
          <td>To Time:</td>
          <td><?php echo $form['toTime']; ?></td>
        </tr>
        <tr>
          <td>Public Access:</td>
          <td><?php echo $form['isPublic']; ?></td>
        </tr>
        <tr>
          <td>RSVP Required:</td>
          <td><?php echo $form['rsvpRequired']; ?></td>
        </tr>
        <tr>
          <td>Location:</td>
          <td><?php echo $form['EventLocations_id']; ?></td>
        </tr>
        <tr>
          <td>Contact Info:</td>
          <td><?php echo $form['EventContacts_id']; ?></td>
        </tr>
        <tr>
          <td>Entry Cost: $</td>
          <td><?php echo $form['cost']; ?></td>
        </tr>
        <tr>
          <td>Tags:</td>
          <td><?php echo $form['tags']; ?></td>
        </tr>
        <tr>
          <td>Active:</td>
          <td><?php echo $form['isActive']; ?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
          <?php echo $form['cancel']; ?> 
          <?php echo $form['save']; ?>
          <?php echo $form['contactSettings'] ?>
          </td>
        </tr>
      </table>
</form>