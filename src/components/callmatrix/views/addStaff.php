

<style>
   
    label, input { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#users-contain { width: 350px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
  </style>
  <script language="javascript">
  $(function() {
	  
	  $( "#fromDate" ).datepicker();
	  
	  $( "#toDate" ).datepicker();
	  
	  
    var dialog, form,
 
      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
      name = $( "#name" ),
      fromDate = $( "#fromDate" ),
      toDate = $( "#toDate" ),
      allFields = $( [] ).add( name ).add( fromDate ).add( toDate ),
      tips = $( ".validateTips" );
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    }
 
    function checkRegexp( o, regexp, n ) {
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }
 
    function addUser() {
      var valid = true;
      allFields.removeClass( "ui-state-error" );
 
      valid = valid && checkLength( name, "name", 3, 16 );
      valid = valid && checkLength( toDate, "toDate", 6, 80 );
      valid = valid && checkLength( fromDate, "fromDate", 5, 16 );
 
      
      if ( valid ) {
        $( "#users tbody" ).append( "<tr>" +
          "<td>" + name.val() + "</td>" +
          "<td>" + email.val() + "</td>" +
          "<td>" + password.val() + "</td>" +
        "</tr>" );
        dialog.dialog( "close" );
      }
      return valid;
    }
 
    dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 350,
      width: 400,
      modal: true,
      buttons: {
        "Add Staff to Calendar": addUser,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );
      }
    });
 
    form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      addUser();
    });
 
    $( "#create-user" ).button().on( "click", function() {
      dialog.dialog( "open" );
    });
  });
  </script>
<button id="create-user">Add Staff</button>

<div id="dialog-form" title="Add Staff to Calendar">
  <p class="validateTips">All form fields are required.</p>
 
  <form>
    <fieldset>
      <label for="name">Name</label>
      <input type="text" name="name" id="name" value="Jane Smith" class="text ui-widget-content ui-corner-all">
      <label for="fromDate">From</label>
      <input type="text" name="fromDate" id="fromDate" value="2014-10-14" class="text ui-widget-content ui-corner-all">
      <label for="toDate">To</label>
      <input type="text" name="toDate" id="toDate" value="2014-10-18" class="text ui-widget-content ui-corner-all">
 
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>
<table class="table">
  <tr>
    <td>Sunday</td>
    </tr>
  <tr>
    <td><button class="btn-xs btn btn-block alert-success">Rick</button></td>
    </tr>
  <tr>
    <td><button class="btn-xs btn btn-block  alert-warning">Loree, Sandra, Mike</button></td>
    </tr>
  <tr>
    <td><button class="btn-xs btn btn-block  alert-info">Rick until 12:00pm only saturday - Stuart (12:00pm Saturday - 8:00am Sunday)</button></td>
    </tr>
  <tr>
    <td><button class="btn-xs btn btn-block  alert-info">Jake/Gil</button></td>
    </tr>
  <tr>
    <td><button class="btn-xs btn btn-block  alert-info">Matt/Jeff/Marna</button></td>
    </tr>
</table>