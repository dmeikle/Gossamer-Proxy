
$( document ).ready(function() {
    
    var submitting = false;
    
    $('.pagination').click(function() {
       
       if(submitting) {
           return;
       }
        var limit = ($(this).data("limit"));
        var offset = ($(this).data("offset"));
        var url = ($(this).data("url"));        
       
        submitting = true;
        window.location = window.location.protocol + "//" + window.location.host + url + '/' +offset + '/' + limit;
    });
    
    
    
});