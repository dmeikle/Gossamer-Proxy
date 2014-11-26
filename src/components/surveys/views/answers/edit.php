<script language="javascript">
  $(function() {
    $( "#nav-tabs" ).tabs();
  });
  </script>



<table class="table">
  <tr>
    <th scope="col">&nbsp;</th>
    <th scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td>Selection</td>
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
                <input class="form-control" type="text" name="category[locale][en_US][category]" value="Each"/>
            </div>  
        	<div class="tab-pane" id="en_US">                   
                <input class="form-control" type="text" name="category[locale][zh_CN][category]" value="Each"/>
            </div>           
                   
                   
       	</div>  
    </td>
  </tr>
 
  <tr>
    <td></td>
    <td><button>Save</button></td>
  </tr>
</table>