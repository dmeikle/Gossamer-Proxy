function populate(frm, data) {alert('here2');
    $.each(data, function(key, value){
        $('[name='+key+']', frm).val(value);
    });
}

$(document).ready(function() {



    $(".editButton").click(function(event) {
        var categoryId = this.dataset.categoryid;

        $.ajax({
            url: '/cart/admin/category/jsonLoad/' + categoryId,
            success: function(data) {alert('here');
                var json = $.parseJSON(data);
                alert(json)
            },
            fail: function(data) {alert('there');
                var json = $.parseJSON(data);
                alert(json)
            },
            dataType: 'json',
            type: 'get'
        });
    });




// variable to hold request
var request;
var SANITY_CHECK = 100;

    function populate(frm, data) {
        $.each(data, function(key, value){
            $('[name='+key+']', frm).val(value);
        });
    }

    //change the total cost based on unit count
    $(".observableCount").change(function(event) {
        var sectionId = this.dataset.sectionid;
        var itemId = this.dataset.itemid;
        var cost = this.dataset.cost;
        var numItems = $(this).val();

        var costPer = cost * numItems;
        var divTag = '#cost_' + sectionId + '_' + itemId + '_itemCost';

        $(divTag).html('$' + costPer.toFixed(2));
        if(costPer > SANITY_CHECK) {
            $(divTag).css('color','red');
        } else{
            $(divTag).css('color','black');
        }
    });


    // bind to the submit event of our form
    $(".saveButton").click(function(event){

        // abort any pending request
        if (request) {
            request.abort();
        }
        // setup some local variables
        var $form = $('form');
        // let's select and cache all the fields
        var $inputs = $form.find("input, select");
        // serialize the data in the form
        var serializedData = $form.serialize();

        // let's disable the inputs for the duration of the ajax request
        // Note: we disable elements AFTER the form data has been serialized.
        // Disabled form elements will not be serialized.
        $inputs.prop("disabled", true);

        // fire off the request to /form.php
        request = $.ajax({
            url: form.action,
            type: "POST",
            data: serializedData
        });

        // callback handler that will be called on success
        request.done(function (response, textStatus, jqXHR){
            // log a message to the console
            //console.log("Hooray, it worked!");
            alert('Items successfully saved');
        });

        // callback handler that will be called on failure
        request.fail(function (jqXHR, textStatus, errorThrown){
            // log the error to the console
            console.error(
                "The following error occured: "+
                    textStatus, errorThrown
            );
            alert("The following error occured: "+ textStatus);
        });

        // callback handler that will be called regardless
        // if the request failed or succeeded
        request.always(function () {
            // reenable the inputs
            $inputs.prop("disabled", false);
        });

        // prevent default posting of form
        event.preventDefault();
    });
});
