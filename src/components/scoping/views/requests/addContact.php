
<script language="javascript">
$( document ).ready(function() {

    $('.cancel').click(function (e) {
        window.location.href='/admin/scoping/requests/0/20';
    });
    
    $('#contact-type').change(function(e) {
       id = $('#contact-type').val();
       if(id < 8) {
           $('#companyRow').show();
           $('#unitRow').hide();
       } else {
            $('#companyRow').hide();
           $('#unitRow').show();
       }
    });
    
    var cache = {};
    function log( message ) {
      $( "<div>" ).text( message ).prependTo( "#log" );
      $( "#log" ).scrollTop( 0 );
    }
 
    $( "#company" ).autocomplete({
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
 
        $.post( "/admin/companies/search", request, function( data, status, xhr ) {
          cache[ term ] = data;
          response( data );
        });
      }
    });
});
</script>


<h2 class="form-signin-heading">Add Contact</h2>
<div class="col-xs-3" style="float:right; margin: 0px 10px 15px 0px">   
    Search: <input type="text" class="form-control" placeholder="enter search term">
</div>
        <table class="table">
              <tr valign="top">
                <td>Contact Type:</td>
                        <td><select name="Contact[contactType]" id="contact-type" class="form-control">
                                <?php echo $ContactTypes; ?>
                    </select></td>
              </tr>
              <tr valign="top" id="companyRow">
                <td>Company:</td>
                <td><input type="text" name="Contact[Companies_id]" id="company"  class="form-control"/></td>
              </tr>
              <tr valign="top" id="unitRow">
                    <td width="18%">Unit Number:</td>
                    <td width="82%"><input type="text" name="Contact[unitNumber]" id="unitNumber"  class="form-control"/></td>
              </tr>
              <tr valign="top">
                <td>Firstname:</td>
                <td><input type="text" name="Contact[firstname]" id="firstname"  class="form-control"/></td>
              </tr>

              <tr valign="top">
                <td>Lastname:</td>
                <td><input type="text" name="Contact[lastname]" id="lastname"  class="form-control"/></td>
              </tr>
              <tr valign="top">
                <td>Email:</td>
                <td><input type="text" name="Contact[email]" id="email"  class="form-control"/></td>
              </tr>
              <tr valign="top">
                <td>Mobile:</td>
                <td><input type="text" name="Contact[mobile]" id="mobile"  class="form-control"/></td>
              </tr>
              <tr valign="top">
                <td>Home:</td>
                <td><input type="text" name="Contact[home]" id="home"  class="form-control"/></td>
              </tr>
              <tr valign="top">
                <td>Office:</td>
                <td><input type="text" name="Contact[office]" id="office"  class="form-control"/></td>
              </tr>
              <tr valign="top">
                <td>Extension:</td>
                <td><input type="text" name="Contact[extension]" id="extension"  class="form-control"/></td>
              </tr>
              <tr valign="top">
                <td>Notes:</td>
                <td><label for="select"></label>
                <input type="text" name="Contact[notes]" id="notes"  class="form-control"/></td>
              </tr>
              <tr valign="top">
                <td>&nbsp;</td>
                <td><button class="btn btn-primary">Add Another</button> <button class="btn btn-primary">Add and Return</button> <button class="cancel btn btn-primary">Cancel</button></td>
              </tr>
         </table>
      
       </form>