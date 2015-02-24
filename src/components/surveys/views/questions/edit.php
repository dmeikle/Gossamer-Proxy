

<h2>Create/Edit Question</h2>
<script language="javascript">

$(document).ready(function() {
    $( "#tabs" ).tabs(); 
    
   
    
    
    
    var cache = {};
  
    function addAnswer( answer ) {
      $( "#sortable" ).append(
      '<li data-id="' + answer.id + '" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>' + answer.value + '</li>'); 
    }
    
    function addAnswerId(answer) {
        $('<input>').attr('type','hidden').attr('name','answerId[]').attr('value', answer.id).appendTo('#form1');
    }
    
    $('#search').on('blur', function(){
        
        $(this).val('');
    });
    
    $( "#search" ).autocomplete({
      minLength: 2,
      select: function( event, ui ) {
          addAnswer(ui.item);
          addAnswerId(ui.item);
          hideSearch();

      },
      source: function( request, response ) {
        var term = request.term;
        if ( term in cache ) {
          response( cache[ term ] );

          addAnswerId(ui.item);
          hideSearch();
          return;
        }
 
        $.post( "/admin/surveys/answers/search", request, function( data, status, xhr ) {

          cache[ term ] = data;
          response( data );
        });
      }
    });
    

    $('#searchToggle').click(function() {
        $('#search').toggle(true);
    });
    function hideSearch() {
     $('#search').toggle(false);   
     $('#search').val('');
    }
    
    $('#Question_QuestionTypes_id').change(function() {
        var url = $(location).attr('href');
        var segments = url.split( '/' );
        var action = segments[6];
        var id = segments[7];

        window.location = '/admin/surveys/questions/' + $(this).val() + '/' + id;
    });
});


</script>

    <style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 30px; }
  #sortable li span { position: absolute; margin-left: -1.3em; }
  
  </style>   
       
<form method="post" name="form1" id="form1">
    <table class="table">
        <tr>
          <td>Question Type</td>
          <td>
             <?php echo $form['QuestionTypes_id']; ?>          
          </td>
        </tr>
        <tr>
            <td>Question</td>
            <td>
            <div id="tabs">
                <ul>
                    <?php
                    foreach($locales as $locale) {?>
                        <li><a href="#<?php echo $locale['locale'];?>"><?php echo $locale['languageName'];?></a></li>
                    <?php } ?>
                </ul>

                <?php foreach($form['question']['locales'] as $key => $row) { ?>
                    <div id="<?php echo $key; ?>">
                        <?php echo $row; ?>
                    </div>
                <?php } ?>

              </div>
            </td>        
        </tr>
        <?php if($QuestionTypes_id < 4) {?>
        <tr>
            <td>Answers</td>
            <td>
               <?php echo $answers; //($form['answer']);?>    
                
                <div class="glyphicon glyphicon-plus" id="searchToggle"> </div><br><input style="display: none" type=text id="search" class="form-control" />
            </td>
         </tr>
         <?php  } ?>
        <tr>
          <td>Active</td>
          <td>
             <?php echo $form['isActive']; ?>          
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
              <button class="btn btn-primary">Save</button> 
              <button class="btn btn-primary" id="cancel">Cancel</button> 
          </td>
        </tr>

    </table>
</form>

