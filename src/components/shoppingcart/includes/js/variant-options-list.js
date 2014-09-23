$( document ).ready(function() {
    $('.variant-option-edit').click(function (e) {
       
        var id = this.dataset.id;
        var pathname = window.location.pathname;
        window.location.href = pathname + '/' + id;
    })
    
});