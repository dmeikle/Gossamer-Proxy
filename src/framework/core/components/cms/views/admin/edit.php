
<script src="https://cdn.ckeditor.com/4.4.5.1/standard/ckeditor.js"></script>

<script language="javascript">

$(document).ready(function() {
    $( "#tabs" ).tabs();
    var permalink = $('#permalink').val();
    
    $("#page_name").keyup(function(){
        var text = $("#page_name").val();
        if(!validate(text)) {
            $("#page_name_container").addClass('has-error');
            $('#page_name_message').toggle(true);
            return;
        } else {
            $("#page_name_container").removeClass('has-error');
            $('#page_name_message').toggle(false);
        }
       
       //add to permalink if it's not already holding a value
        if(permalink == '') {
            text = text.replace(/ /g, '-');        
            $("#permalink").val(text);
            $("#permalink").trigger('keyup');//fire the change event
        }
    }); 
    
    $('#permalink').keyup(function() {
        $("#permalink").val($("#permalink").val().replace(/ /g, '-'));
        $('#page_name_display').text($("#permalink").val());
    });
    
    function validate(text){

        var reg=/[^a-zA-Z0-9 \_\-]+/;
        if(reg.test(text)){              
            return false;
        }               

    return true;
    }
    
    //setup before functions
    var typingTimer;                //timer identifier
    var doneTypingInterval = 1000;  //time in ms, 1 seconds

    //on keyup, start the countdown
    $('#page_name').keyup(function(){
        clearTimeout(typingTimer);
        typingTimer = setTimeout(checkPageNameExists, doneTypingInterval);
    });

    //on keydown, clear the countdown 
    $('#page_name').keydown(function(){
        clearTimeout(typingTimer);
    });

    //user is "finished typing," do something
    function checkPageNameExists () {
        $.post('/admin/cms/pages/search/' + $('#pageId').val(), {'permalink':$("#page_name_display").text()}, function(data) { //make ajax call to check
           // $("#user-result").html(data); //dump the data received from PHP page
            if(data.result != false) {
                $('#page_name_exists').show();
                $('#update_page').attr('disabled','disabled');
            }else {
                $('#page_name_exists').hide();
                $('#update_page').removeAttr('disabled');
            }
        });
    }
    
    $('#edit-permalink').click(function() {
        $('#permalink-container').show();
    });
    
    $('#save-permalink').click(function() {
        $.post('/admin/cms/pages/permalink/save', {'pagename':$("#permalink").val()}, function(data) { //make ajax call to save
           // $("#user-result").html(data); //dump the data received from PHP page
            if(data.result == true) {                
                $('#permalink-container').hide();
            }
        });
    });
    
       
    $('#page_content').change(function(){
         
        var txt = $('#page_content').text()
          , charCount = txt.length
          , wordCount = txt.replace( /[^\w ]/g, "" ).split( /\s+/ ).length
          ;
        $( '#wordcount' ).text(wordCount);
    });
    
    $('#update_page').click(function(e) {
        e.stopPropagation();
       CKupdate();
        $.ajax({
           type: "POST",
           url: '/admin/cms/pages/' + $('#pageId').val(),
           data: $("#form1").serialize(), // serializes the form's elements.
           success: function(data)
           {
               alert('save successful'); // show response from the php script.
               $('#update_warning').hide();
           }
         });
    });
    
    $('#show-preview').click(function() {
       updatePreview();
       var dialog = $( "#preview-container" );
        dialog.position({
            my: "center",
            at: "center",
            of: window
        });
       
       $( "#preview" ).html($('#page_content').val());
       dialog.show();
    });
    
    function updatePreview() {
       CKupdate();
        $.ajax({
           type: "POST",
           url: '/admin/cms/pages/' + $('#pageId').val(),
           data: 'name[locale][en_US][preview]=' + $('#page_content'), // serializes the form's elements.
           success: function(data)
           {
               //$('#update_warning').hide();
           }
         });
    }
    
    var currentStatus = '';
    var isPublished = '';
    
    $('#edit-visibility').click(function() {
        
        $(this).prev('#CmsPage_isPublic').toggle();
        if($(this).text() == 'cancel') {
            $(this).text(currentStatus);
        } else {
            $(this).text('cancel');
            currentStatus = $(this).prev('#page_isPublic').children("option").filter(":selected").text(); 
        }
    });

    $('#CmsPage_isPublic').change(function() {
        if($(this).val() != currentStatus && confirm("are you sure you want to change the status of this page?")) {           
            $(this).next().text($(this).children("option").filter(":selected").text());
            $('#update_warning').show();
        } else {
            $(this).next().text(currentStatus);
        }
        $(this).toggle();
    }); 
    
    
    $('#edit-status').click(function() {
       
        $(this).prev('#CmsPage_isPublished').toggle();
        if($(this).text() == 'cancel') {
            $(this).text(isPublished);
        } else {
            isPublished = $(this).prev('#CmsPage_isPublished').children("option").filter(":selected").text(); 
            $(this).text('cancel');
        }
    });
    
    $('#CmsPage_isPublished').change(function() {
        if($(this).val() != isPublished && confirm("are you sure you want to change the publishing of this page?")) {
            $(this).next().text($(this).children("option").filter(":selected").text());
            $('#update_warning').show();            
        } else {
            $(this).next().text(isPublished);
        }
        $(this).toggle();
    }); 
    
    function CKupdate(){
        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }            
    }

    $('#undo_page').click(function() {
        location.reload();
    });
    
    $('#hide-preview').click(function() {
        $('#preview-container').hide();
        $('#preview').html('');
    });
    
    $('#view-existing').click(function() {
        $.ajax({
            type: "GET",
            url: '/admin/cms/page/preview/' + $('#pageId').val(),
            success: function(data)
            {
                var page = data.Page;
                if (typeof page == "undefined") {
                    return;
                }
                showExisting(page[0].content);               
            }
        });
    });
    
    function showExisting(content) {
       
        var dialog = $( "#preview-container" );
        dialog.position({
            my: "center",
            at: "center",
            of: window
        });
       
        $( "#preview" ).html(content);
        dialog.show();
    }
    var currentCategory = '';
    
    $('#page_category').change(function() {
        if($('#page_category') != currentCategory) {
            $('#slug').html($('#page_category option:selected').text());
            $('#update_warning').show();
        }
    });
    
    $('#CmsPage_CmsSections_id').on('change', function() {
       $('#slug').text($(this).find(':selected').data('slug'));
    });
});
</script>


<style>
    #preview-container {
        background-color: #fff;  
        position: absolute;  
        z-index: 10000;
        width: 900px;
    }
    #preview {
        padding: 10px
    }
</style>


 <div id="preview-container" style="display: none;" class="panel panel-default">
     <div id="hide-preview" style="float:right; width: 20px; padding: 5px">x</div>
    	<div class="panel-heading">Pages</div>
        <div id="preview">

        </div>
    </div>

      <div class="panel panel-default">
    	<div class="panel-heading">Pages</div>
        <form role="form" id="form1" method="post">
          <?php echo $form['pageId']; ?>
        <table class="table">
            <tr>
                <td rowspan="6" width="200" valign="top">
                    <p>Dashboard</p>
                    <p>Posts</p>
                    <p>Pages</p>
                    <p>Sections</p>
                    <ul>
                    <?php /* foreach($sections as $section) {?>
                        <li> <?php echo $section['name'];?></li> 
                    <?php } */?>
                    </ul>
                    
                    <p>- add new</p>
                    <p>Posts</p>
                    <p>Comments<br />
                    </p>
                </td>                            
                <td><p>Page Name: (internal use only)</p>
                    <p class="btn bg-danger" style="display:none" id="page_name_message">Invalid characters in Page name. Please remove</p>
                    <p class="btn bg-danger" style="display:none" id="page_name_exists">Page name exists.</p>
                    <div class="form-group" id="page_name_container">
                       <?php echo $form['name'];?>
                    </div>
                </td>                
            </tr>
            <tr>
                <td>Permalink: localhost/<span id="slug">__slug</span>/<span id="page_name_display"><?php echo $page['permalink'];?></span> <a href="#" onclick="return false;" class="btn-xs" id="edit-permalink">edit</a> <a href="#" id="view-existing" onclick="return false;" class="preview btn-xs">view existing page</a>
                    <div id="permalink-container" style="display:none">
                        <?php echo $form['permalink'];?>
                        <input type="button" id="save-permalink" class="btn btn-primary btn-xs" value="Update" />
                    </div>
                </td>
                <td rowspan="2" valign="top" width="200"><p>Publish</p>
                  <p>
                    <input type="button" id="show-preview" name="preview" class="btn btn-xs btn-primary preview" value="Preview Changes" />
                    <br />
                    Status: 
                    <?php echo $form['isPublished'];?>
                    
                    <a href="#" onclick="return false;" class="btn-xs" id="edit-status">Offline</a><br />
                  <!--  
                  Visibility:  
                 
                    <select name="page[isPublic]" id="page_isPublic" style="display: none">
                        <option value="1" <?php //echo ($page['isPublic'] == 1)?'selected':''?>>Public</option>
                        <option value="0" <?php //echo ($page['isPublic'] != 1)?'selected':''?>>Private</option>
                    </select>                  
                  <a href="#" onclick="return false;" class="btn-xs" id="edit-visibility">Public</a><br />
                  
                  -->
                  
                 </p> 
                  <p>
                  Section:
                  <?php echo $form['CmsSections_id'];?>
                  
                  </p>
                  <p><input type="button" name="update" id="undo_page" class="btn btn-xs btn-primary" value="Undo Changes" />
                   
                    <?php echo $form['update'];?>
                    <div class="bg-warning" style="display:none" id="update_warning">Changes have been made. Please click the 'Update' button to save these changes<br /><br/>To undo these changes click the 'Undo Changes' button.</div>
                  </p> 
              </td>                                           
			</tr>
            <tr>
              <td>
                  <div id="tabs">
               <ul>
                    <?php
                    foreach($locales as $locale) {?>
                        <li><a href="#<?php echo $locale['locale'];?>"><?php echo $locale['languageName'];?></a></li>
                    <?php } ?>
                </ul>

            <div id="tab-content">
                
               
                <?php foreach($locales as $locale) {                   
                    ?>
                 <div class="tab-pane<?php echo ($locale['isDefault']) ? ' active':'';?>" id="<?php echo $locale['locale'];?>">
                <table width="100%">
                    <tr>
                        <td>
                            <?php echo $form['content']['locales'][$locale['locale']];?>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                               CKEDITOR.replace( 'CmsPage_locale_<?php echo $locale['locale']; ?>_content' );
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td> <p>Page Title (inside HTML head tags):</p>
                            <?php echo $form['metaTitle']['locales'][$locale['locale']];?>
                    </tr>
                </table>
                 </div>
                <?php } ?>      
                
           
            </div>
                  </div>
              </td>
           	</tr>
            <tr>
              <td>
              <div style="float:right">Last edited by <?php echo $form['staffName']; ?> on <?php echo $form['lastModified']; ?></div>
              </td>
              <td rowspan="3" valign="top">&nbsp;</td>
            </tr>
           
            <tr>
              <td><p>Summary:</p>
              <p>
               <?php echo $form['summary']?>
                Summaries are a brief description of your content
              </p></td>
            </tr>
            
            <tr>
              <td>           
               <?php echo $form['submit']?>
             </td>
            </tr>
        </table>
       
</form>
      </div>

