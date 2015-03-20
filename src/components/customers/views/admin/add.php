
<script language="javascript">
$( document ).ready(function() {

    $('.cancel').click(function (e) {
        window.location.href='/admin/Customer/0/20';
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


<h2 class="form-signin-heading">Add Customer</h2>
<div class="col-xs-3" style="float:right; margin: 0px 10px 15px 0px">   
    Search: <input type="text" class="form-control" placeholder="enter search term">
</div>

<form method="post">
    <table class="table">
        <tr valign="top">
            <td>Customer Type:</td>
            <td>
                 <?php echo $form['CustomerTypes_id']; ?>
            </td>
        </tr>
        <tr valign="top" id="companyRow">
          <td>Company:</td>
          <td><input type="text" name="Customer[Companies_id]" id="company"  class="form-control"/></td>
        </tr>
        <tr valign="top">
          <td>Firstname:</td>
          <td><?php echo $form['firstname']; ?></td>
        </tr>

        <tr valign="top">
          <td>Lastname:</td>
          <td><?php echo $form['lastname']; ?></td>
        </tr>
        <tr valign="top">
          <td>Email:</td>
          <td><?php echo $form['email']; ?></td>
        </tr>
        <tr valign="top">
          <td>Mobile:</td>
          <td><?php echo $form['mobile']; ?></td>
        </tr>
        <tr valign="top">
          <td>Home:</td>
          <td><?php echo $form['home']; ?></td>
        </tr>
        <tr valign="top">
          <td>Office:</td>
          <td><?php echo $form['office']; ?></td>
        </tr>
        <tr valign="top">
          <td>Extension:</td>
          <td><?php echo $form['extension']; ?></td>
        </tr>
        <tr valign="top">
          <td>Notes:</td>
          <td><label for="select"></label>
          <?php echo $form['notes']; ?></td>
        </tr>
        <tr>
            <td>

            </td>
            <td>
                 <?php echo $form['submit']; ?>
                 <?php echo $form['cancel']; ?>
                
            </td>
        </tr>
      </table>
</form>