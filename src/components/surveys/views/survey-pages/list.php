<?php echo __YML_KEY;?>
<h3>Survey Page List</h3>
<script language="javascript">

$(document).ready(function() {
   
    $('.cancel').click(function() {
      window.location = '/admin/surveys/0/20' ;
   });
   
    var cache = {};
  
    function addRow( row ) {
      $( "#sortable" ).append(
      '<li id="SurveyPanes_id-' + row.id + '" class="new"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>' + row.value + '</li>'); 
    }
    
    function addRowId(row) {
        $('<input>').attr('type','hidden').attr('name','pageId[]').attr('value', row.id).appendTo('#form1');
    }
    
    $('#search').on('blur', function(){
        
        $(this).val('');
    });
    
    $( "#search" ).autocomplete({
      minLength: 2,
      select: function( event, ui ) {
          addRow(ui.item);
          addRowId(ui.item);
          hideSearch();

      },
      source: function( request, response ) {
        var term = request.term;
        if ( term in cache ) {
          response( cache[ term ] );

        //  addRowId(ui.item);
          hideSearch();
          return;
        }
 
        $.post( "/admin/surveys/pages/search", request, function( data, status, xhr ) {

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
        $('#trashcan').empty();
        $('#trashcan').append('<span class="glyphicon glyphicon-trash"></span>');
       
            var data = $(this).sortable('serialize');
            var url = window.location.pathname.split( '/' );
           
            $.ajax({
                data: data,
                type: 'POST',
                url: '/admin/surveys/pages/saveorder/' + url[5]
            });
            setLIColors();
        },
        receive: function (event, ui) {
            var data = $(this).sortable('serialize');
            var url = window.location.pathname.split( '/' );
            
            $.ajax({
                data: data,
                type: 'POST',
                url: '/admin/surveys/pages/saveorder/' + url[5]
            });
        }
    });
    
    $( "#sortable" ).disableSelection();
    
    
    $('#save').click(function() {
        $('#trashcan').empty();
        $('#trashcan').append('delete me');
        
        var data = $( "#sortable" ).sortable('serialize');
        var url = window.location.pathname.split( '/' );

        $.ajax({
            data: data,
            type: 'POST',
            url: '/admin/surveys/pages/saveorder/' + url[5]
        });
        //location.reload();
        setLIColors();
    });
    
    function setLIColors() {
        $('#sortable').children().removeClass('ui-state-default ui-sortable-handle').addClass('ui-state-default ui-sortable-handle');
    }
    
    $( "#sortable, #trashcan" ).sortable({
      connectWith: ".connectedSortable"
    }).disableSelection();
});

</script>

<style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 30px; }
  #sortable li span { position: absolute; margin-left: -1.3em; }
  .new {
      background-color: infobackground;
  }
  </style>

<form method="post" id="form1">
    <table class="table">    
    <tr>
        <th>
            Pane List
        </th>
    </tr>
    <tr>
        <td>
           
            <div id="trashcan" class="connectedSortable" style="float:right" title="drop here to delete pane">
                <span class="glyphicon glyphicon-trash"></span>
            </div>
            
            <ul id="sortable" class="connectedSortable">


    <?php
   
    foreach($SurveyPages as $page) {
        if(count($page) == 0) {
            continue;
        }
    ?>
                <li id="SurveyPanes_id-<?php echo $page['id'];?>" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?php echo $page['name'];?></li>

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
           <!-- not needed <input type="button" id="save" class="btn btn-default" value="Save" /> -->
            <input type="cancel" class="btn btn-default cancel" value="Return" /> 

        </td>
    </tr>
    </table>
</form>