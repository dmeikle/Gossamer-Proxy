/* 
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */


$(document).ready(function () {

    $.ajaxSetup({
        beforeSend: function () {
            // show gif here, eg:
            $("#loading").show();
        },
        complete: function () {
            // hide gif here, eg:
            $("#loading").hide();
        }
    });
    $('.edit').click(function (e) {
        // var staffId =  $(this).data('id');
        //  $('#myForm').trigger("reset");
        $("#feature-slider-edit").panel("open");

//       $.get( '/admin/staff/ajaxedit/' + staffId,
//           function(data) {
//               
//                $.each(data.Staff, function(i, item) {
//                   $('#Staff_' + i).val(item);
//                });
//            }
//        );
//        $('#staffId').val(staffId);
    });

    $('.view-ticket').click(function () {
        $('#left-feature-slider').toggle('true');
    });

    $('.ticket-cancel').click(function () {
        $('#left-feature-slider').toggle('false');
    });
});