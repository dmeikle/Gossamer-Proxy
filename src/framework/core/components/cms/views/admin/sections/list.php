

<script language="javascript">

$(document).ready(function() {
   
   
    //user is "finished typing," do something
    $('#save_category').click(function() {       
        $.ajax({
           type: "POST",
           url: '/admin/cms/sections/save/' + $('#sectionId').val(),
           data: $("#form1").serialize(), // serializes the form's elements.
           success: function(data)
           {
               if(data == false) {
                   //error occured
               } else {
                   var section = data.section;
                   if($('#sectionId').val() == 0) {                       
                        appendRow(section);
                   } 
                $('#section_locale_en_US').val('');
                $('#section_slug').val('');
                $('#section_description').val('');
                $('#sectionId').val('0');
               }              
            }
         });
    });
    
    
    function appendRow(data) {
        var tr = '<tr><td>' + data.locale.en_US.name + '</td><td>' + data.slug +
            '</td><td>' + data.description + '</td><td><button class="btn btn-primary btn-xs edit" data-id="' + data.id + '">Edit</button> ' +
            '<button class="btn btn-primary btn-xs remove" data-id="' + data.id + '">Remove</button></td></tr>';
    
        $('#section_list > tbody:last').append(tr);
    }
    
    $('.section-edit').click(function(e) {
        e.stopPropagation();       
        loadSection($(this).data('id'));        
    });
    
    function loadSection(id) {
        $.ajax({
            type: "GET",
            url: '/admin/cms/section/view/' + id,
            success: function(data)
            {
                console.log(data);
               
               // var section = data[0];
                //$('#section_locale_en_US').val(data.locales.en_US.sectionName);
                $('#section_locale_en_US').val(data.sectionName);
                $('#section_slug').val(data.slug);
                $('#section_description').val(data.description);
                $('#sectionId').val(data.id);
            }
        });
    }
    
    $('.section-remove').click(function(e) {
        var tr = $(this).closest('tr');
        
       $.ajax({
            type: "POST",
            url: '/admin/cms/section/remove/' + $(this).data('id'),
            data: "id="+ $(this).data('id'),
            success: function(data)
            {
                console.log(data);
                if(data.result == true) {               
                    tr.remove(); 
                }
            }
        }); 
    });
});

</script>


<div class="panel panel-default">
    	<div class="panel-heading">Pages</div>
        <form role="form" id="form1">
            <input type="hidden" id="sectionId" value="0" />
        <table class="table">
            <tr>
                <td width="200" valign="top"><p>Add New Section</p>
                <p>Name</p>
                <p>
                  <input type="text" name="section[locale][en_US][sectionName]" class="form-control" id="section_locale_en_US" />
                </p>
                <p>Slug</p>
                <p>
                  <input type="text" name="section[slug]" class="form-control" id="section_slug" />
                </p>
                <!--
                <p>Parent</p>
                <p>
                  <select name="section[parentId]" class="form-control" id="section_parentId">
                  </select>
                </p>
                -->
                <p>Description</p>
                <p>
                  <textarea name="section[description]" class="form-control" id="section_description" cols="45" rows="5"></textarea>
                </p>
                <p>
                  <input type="button" name="button" id="save_category" value="Save Section" />
                </p></td>
                <td width="200" valign="top"><table class="table table-striped table-hover" id="section_list">
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Action</th>
                  </tr>
                  <?php
                  foreach($CmsSections as $section) {
                      ?>                  
                  <tr>
                    <td><?php echo $section['sectionName'];?></td>
                    <td><?php echo $section['description'];?></td>
                    <td><?php echo $section['slug'];?></td>
                    <td>
                        <input type="button" class="btn btn-primary btn-xs section-edit" data-id="<?php echo $section['id'];?>" value="Edit" />
                        <input type="button" class="btn btn-primary btn-xs section-remove" data-id="<?php echo $section['id'];?>" value="Remove" />
                    </td>
                  </tr>
                  <?php
                  }
                  ?>
                  
                    </table>
                   
                    
                </td>                            
           	</tr>
        </table>
        
</form>
      </div>