

<h2>Work Performed</h2>
<script language="javascript">

$(document).ready(function() {
    $( "#tabs" ).tabs(); 
});

</script>
<form role="form" action="post">
<table class="table">       
       <tr>
         <td>Name</td>
         <td>
         <div id="tabs">
            <ul>
              <li><a href="#en_US">English</a></li>
              <li><a href="#zh_CN">Chinese</a></li>
            </ul>
            <div id="en_US">
                <input class="form-control" name="workperformed[locales][en_US]" value="this is an english action" />
            </div>
            <div id="zh_CN">
              <input class="form-control" name="workperformed[locales][zh_CN]" value="this is a chinese action" />
            </div>
          </div>
         </td>
       </tr>
       <tr>
         <td>Department</td>
         <td><select class="form-control" name="select" id="select">
         </select></td>
       </tr>
       <tr>
         <td>Phase</td>
         <td><select class="form-control" name="select2" id="select2">
         </select></td>
       </tr>
       <tr>
         <td>Layer</td>
         <td>
            <select class="form-control" name="select3" id="select3">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
             <span class="alert-info">example: <br />1 - Baseboard<br />2 - Drywall<br />3 - Insulation</span>
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