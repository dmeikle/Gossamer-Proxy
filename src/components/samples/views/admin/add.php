
  <script language="javascript">
  $(function() {
        $('.selectable input:checkbox:checked').each(function(){
          
            $("label[for='" + this.id + "']").addClass('ui-selected');
        });
        
         $('.selectable').on('mouseup','label',function(){
            var el = $(this);
            console.info(el);
            if(el.hasClass('ui-selected')){
                el.removeClass('ui-selected');
            }else{
                el.addClass('ui-selected');
            }          
        })
        
        $('#sampleDate').datepicker();
        
    });
  </script>

<table class="table">
  <tr>
    <td width="51">Job #</td>
    <td width="651"><input type="text" class="form-control" name="sample[claim]" /></td>
    <td width="59">Date:</td>
    <td width="124"><input type="text" class="form-control" name="sample[dateTaken]" id="sampleDate" /></td>
  </tr>
  <tr>
    <td>Staff:</td>
    <td colspan="3"><select class="form-control" name="select" id="select">
    </select></td>
  </tr>
  <tr>
    <td>Unit</td>
    <td colspan="3">
       <select class="form-control" name="select" id="select">
    </select>
    </td>
  </tr>
  <tr>
    <td>Address</td>
    <td colspan="3">
      1234 University Place, Surrey, BC, v4v 4v4
    </td>
  </tr>
  <tr>
    <td>Types</td>
    <td colspan="3">
    	<p class="selectable">
            <label for="accounting"><input id="accounting" type="checkbox" name="userAuthorizations[IS_ACCOUNTING]" value="1">Drywall</label>
            <label for="accounts"><input id="accounts"  type="checkbox" name="userAuthorizations[IS_ACOUNTS_PAYABLE]" value="1">Baseboard</label>
            <label for="administrator"><input id="administrator"  type="checkbox" name="userAuthorizations[IS_ADMINISTRATOR]" value="1">Cove Base</label>
            <label for="manager"><input id="manager" type="checkbox" name="userAuthorizations[IS_MANAGER]" value="1">Casing</label> 
            <label for="accounting"><input id="accounting" type="checkbox" name="userAuthorizations[IS_ACCOUNTING]" value="1">Drywall</label>
            <label for="accounts"><input id="accounts"  type="checkbox" name="userAuthorizations[IS_ACOUNTS_PAYABLE]" value="1">Baseboard</label>
            <label for="administrator"><input id="administrator"  type="checkbox" name="userAuthorizations[IS_ADMINISTRATOR]" value="1">Cove Base</label>
            <label for="manager"><input id="manager" type="checkbox" name="userAuthorizations[IS_MANAGER]" value="1">Casing</label> 
            <label for="accounting"><input id="accounting" type="checkbox" name="userAuthorizations[IS_ACCOUNTING]" value="1">Drywall</label>
            <label for="accounts"><input id="accounts"  type="checkbox" name="userAuthorizations[IS_ACOUNTS_PAYABLE]" value="1">Baseboard</label>
            <label for="administrator"><input id="administrator"  type="checkbox" name="userAuthorizations[IS_ADMINISTRATOR]" value="1">Cove Base</label>           
        </p>
    </td>
  </tr>
  <tr>
    <td>Other:</td>
    <td colspan="3"><input type="text" class="form-control" name="sample[other]" /></td>
  </tr>
  <tr>
    <td>Other:</td>
    <td colspan="3"><input type="text" class="form-control" name="sample[other]" /></td>
  </tr>
  <tr>
    <td>Other:</td>
    <td colspan="3"><input type="text" class="form-control" name="sample[other]" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">
        <button class="btn btn-primary" >Save</button>
        <button class="btn btn-primary">Cancel</button>
    </td>
  </tr>
</table>