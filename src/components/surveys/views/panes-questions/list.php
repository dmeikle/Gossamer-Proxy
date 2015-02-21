<script language="javascript">

$(document).ready(function() {
   
    
    var cache = {};
  
    function addQuestion( question ) {
      $( "#sortable" ).append(
      '<li id="Questions_id-' + question.id + '" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>' + question.value + '</li>'); 
    }
    
    function addQuestionId(question) {
        $('<input>').attr('type','hidden').attr('name','questionId[]').attr('value', question.id).appendTo('#form1');
    }
    
    $('#search').on('blur', function(){
        
        $(this).val('');
    });
    
    $( "#search" ).autocomplete({
      minLength: 2,
      select: function( event, ui ) {
          addQuestion(ui.item);
          addQuestionId(ui.item);
          hideSearch();

      },
      source: function( request, response ) {
        var term = request.term;
        if ( term in cache ) {
          response( cache[ term ] );

          addQuestionId(ui.item);
          hideSearch();
          return;
        }
 
        $.post( "/admin/surveys/questions/search", request, function( data, status, xhr ) {

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
    
    
    $( "#sortable" ).sortable({
        axis: 'y',
        stop: function (event, ui) {
            var data = $(this).sortable('serialize');
            var url = window.location.pathname.split( '/' );
            
            $.ajax({
                data: data,
                type: 'POST',
                url: '/admin/surveys/panes/questions/saveorder/' + url[5]
            });
        }
    });
    
    $( "#sortable" ).disableSelection();
    
    
    $('#save').click(function() {
        var url = window.location.pathname.split( '/' );
        alert(url[5]);
    var segments = url.split('/');
    alert(segments[0]);
    });
});

</script>

<style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 30px; }
  #sortable li span { position: absolute; margin-left: -1.3em; }
  </style>
  
<h3>Questions</h3>
<form method="post" id="form1">
    <table class="table">    
    <tr>
        <th>
            Question
        </th>
    </tr>
    <tr>
        <td>
            <ul id="sortable">


    <?php
    foreach($SurveyPaneQuestions as $question) {
        if(count($question) == 0) {
            continue;
        }
    ?>
                <li id="Questions_id-<?php echo $question['id'];?>" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?php echo $question['question'];?></li>

    <?php } ?>
            </ul>
    </td>
    </tr>
    <tr>
        <td>
            <div class="glyphicon glyphicon-plus" id="searchToggle"> </div><br>
            <input style="display: none" type=text id="search" class="form-control" />

        </td>
    </tr>
    <tr>
        <td>
            <input type="button" id="save" class="btn btn-default" value="Save" /> 
            <input type="cancel" class="btn btn-default" value="Cancel" /> 

        </td>
    </tr>
    </table>
</form>