
$( document ).ready(function() {
    
   // $( "#locale-change" ).dialog( "option", "hide" );
    
    $('#locale-icon').click(function() {
        $(function() {
            $( "#dialog" ).dialog();
          });
    });
    
    $('.select-locale').click(function() {
        var locale = ($(this).data("id"));
        $('#locale-change #locale').val(locale);
        $('#locale-change').submit();
    });
    
    
    
});