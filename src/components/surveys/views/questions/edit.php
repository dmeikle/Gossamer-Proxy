<style>
    #sortable {
        width: 50%;
    }
    
    .ui-autocomplete-loading {
        background: white url("/images/ui-anim_basic_16x16.gif") right center no-repeat;
    }
</style>

<script language="javascript">
  $(function() {
    $( "#tabs" ).tabs();
    
    
    jQuery("#sortable").sortable({
        axis: 'y',
        delay: 100,
        revert: 300
    });
    jQuery("#sortable").disableSelection();
    $("#sortable").bind("sortstop",function(event, ui){
        //ui.item.effect("fade", {}, 1000);
        jQuery("#sortable > li").each(function(n,item){
            if (item.id==3) {
                jQuery(item).effect("fade", {}, 500, function(){
                    jQuery(item).remove();
                });
                //jQuery(item).remove();
            }
        });
    });
    
    $(".removeAnswer").click(function() {
        alert('here');
        var item = $(this).parent().parent();
        
        jQuery(item).effect("fade", {}, 500, function(){
            jQuery(item).remove();
        });
    })
    
     
    
    
    var cache = {};
    function log( message ) {
      $( "<div>" ).text( message ).prependTo( "#log" );
      $( "#log" ).scrollTop( 0 );
    }
 
    $( "#sheetAnswers" ).autocomplete({
      minLength: 2,
      select: function( event, ui ) {
        log( ui.item ?
          "Selected: " + ui.item.value + " aka " + ui.item.id :
          "Nothing selected, input was " + this.value );
      },
      source: function( request, response ) {
        var term = request.term;
        if ( term in cache ) {
          response( cache[ term ] );
          return;
        }
 
        $.post( "/admin/scoping/sheetanswers/search", request, function( data, status, xhr ) {
          cache[ term ] = data;
          response( data );
        });
      }
    });
    
    
    
    $('#questionType').change(function() {
        if($('#questionType option:selected').text() != 'Text') {
            $('#answerRow').toggle(true);
        } else {
             $('#answerRow').toggle(false);
        }
    });
  });
  </script>


<table class="table">
  <tr>
    <th scope="col">&nbsp;</th>
    <th scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td>Question</td>
    <td>
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#en_US" role="tab" data-toggle="tab">English</a></li>
            <li><a href="#en_US" role="tab" data-toggle="tab">Chinese</a></li>
        </ul>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    	<div class="tab-content">
        	<div class="tab-pane active" id="en_US">                   
                <input class="form-control" type="text" name="category[locale][en_US][category]" value="S/I Insulation to Walls"/>
            </div>  
        	<div class="tab-pane" id="en_US">                   
                <input class="form-control" type="text" name="category[locale][zh_CN][category]" value="S/I Insulation to Walls"/>
            </div> 
       	</div>  
    </td>
  </tr> 
  <tr>
    <td>Type:</td>
    <td><select class="form-control" name="select" id="questionType">
            <option>Text</option>
            <option>Multi-Select Button</option>
    </select></td>
  </tr>
  <tr id="answerRow" style="display: none">
    <td>Answers</td>
    <td>
        <ul id='sortable'>
            <li id="1"><div style="float:right"><a class="removeAnswer">x</a></div>Size</li>
            <li id="2"><div style="float:right"><a class="removeAnswer">x</a></div>R</li>
            <li id="3"><div style="float:right"><a class="removeAnswer">x</a></div>Square Feet</li>
        </ul>
        
        <div class="ui-widget">
            <label for="sheetAnswers">New Answer: </label>
            <input id="sheetAnswers">
        </div>
        <!-- <div class="ui-widget" style="margin-top:2em; font-family:Arial">
           Result:
            <div id="log" style="height: 200px; width: 300px; overflow: auto;" class="ui-widget-content"></div>
        </div> -->
    </td>
  </tr>
  <tr>
      <td></td>
      <td>
          <button class="btn btn-primary" id="save">Save</button> 
          <button class="btn btn-primary" id="cancel">Cancel</button> 
      </td>
  </tr>
</table>