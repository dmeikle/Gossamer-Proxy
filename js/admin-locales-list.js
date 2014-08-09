$( document ).ready(function() {
    $('.edit').click(function (e) {
        var id = this.dataset.id;
        window.location.href='locales/' + id;
    })

    $('.cancel').click(function (e) {
        var id = this.dataset.id;
        window.location.href='locales';
    })
    
    $(document).ready(function(){
    $('#icon').change(function(){
            $('#imagePreview').html('<img src="/images/flags/'+$('#icon').val()+'"/>');
    });
});
});