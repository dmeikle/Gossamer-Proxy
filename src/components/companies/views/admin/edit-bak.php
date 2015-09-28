



<form role="form" class="form-standard" method="post">
    <table class="table">
      <tr>
          <td>Name:</td>
          <td><input type="text" class="form-control" name="company[name]" id="company_name"></td>
      </tr>
      <tr>
        <td>Type:</td>
        <td>
            <select class="form-control" name="company[CompanyTypes_id]">
                <option>load company types</option>
            </select>
        </td>
      </tr>
      <tr>
        <td>Address:</td>
        <td><input type="text" class="form-control" name="company[address1]" id="company_address1">
        <input type="text" class="form-control" name="company[address2]" id="company_address2"></td>
      </tr>
      <tr>
        <td>City:</td>
        <td><input type="text" class="form-control" name="company[city]" id="company_city"></td>
      </tr>
      <tr>
        <td>Province:</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Postal Code:</td>
        <td><input type="text" class="form-control" name="company[postalCode]" id="company_postalCode"></td>
      </tr>
      <tr>
        <td>Telephone:</td>
        <td><input type="text" class="form-control" name="company[telephone]" id="company_telephone"></td>
      </tr>
      <tr>
        <td>Fax:</td>
        <td><input type="text" class="form-control" name="company[fax]" id="company_fax"></td>
      </tr>
      <tr>
        <td>URL:</td>
        <td><input type="text" class="form-control" name="company[url]" id="company_url"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
        	<button class="btn btn-primary" id="save">Save</button> 
        	<button class="btn btn-primary" id="cancel">Cancel</button>         
        </td>
      </tr>
    </table>
</form>
