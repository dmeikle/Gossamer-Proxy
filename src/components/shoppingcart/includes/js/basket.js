$( document ).ready(function() {
    
    $(".confirm").confirm({
        
        text: "Are you sure you want to remove that item?",
        title: "Confirmation required",
        confirm: function(button) {
            var id = $(button).attr('data-key'); 
            $("#productKey").val(id);
            $("#removeItemForm").submit();
        },
        cancel: function(button) {
            // do something
        },
        confirmButton: "Yes I am",
        cancelButton: "No",
        post: true
    });
    
});