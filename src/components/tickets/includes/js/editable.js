/* 
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
function editpage(formId) {
  
    $('#editnav').toggle(true);
    $('.editable-fieldset').prop("disabled", false);
    return;
    
    $( '#' + formId + ' .editable' ).each(function() {       
        
        if($(this).is('select')) {
            $(this).attr({'style':''});
            $(this).removeClass('uneditable');
        } else {
            $(this).attr('contenteditable', 'true');
        }
        
        $(this).addClass('editmode');
    });
}


function unedit() {
    $('#editnav').toggle(false);
    $('.editable-fieldset').prop("disabled", "disabled");
    return;
    $( ".editable" ).each(function() {   
        if($(this).is('select')) {
            $(this).attr({'style':'pointer-events: none; cursor: default;'});
            $(this).addClass('uneditable');
        } else {
            $(this).attr('contenteditable', 'false');
        }
        
        $(this).removeClass('editmode');
    });
}