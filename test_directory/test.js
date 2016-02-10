//$(document).ready( function() {
//
//    //$("a").addClass("test");
//    //
//    //$( "#test_button" ).click(function( event ) {
//    //
//    //    alert( "Thanks for visiting!" );
//    //    $("a").addClass("test");
//    //
//    //});
//    //
//    //$("a").click(function (event) {
//    //
//    //    alert("Not exit!");
//    //    event.preventDefault();
//    //    $("a").removeClass("test");
//    //
//    //});
//
//    $('#input_test').validate({
//        rules: {
//            'test_input': {
//                required: true,
//                minlength: 10,
//            },
//        },
//        message: {
//            'test_input': {
//                required: 'inserire un valore',
//                minlength: 'valore troppo corto',
//            },
//        },
//        errorPlacement: 'div',
//        errorPlacement: function(error, element) {
//            error.insertAfter(element);
//        };
//    });
//
//});

function valida() {
    var _input = document.getElementById(['test_input_id']);
    alert(_input.value);
}
