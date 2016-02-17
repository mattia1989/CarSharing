$(document).ready(function() {
    // qui inserisco le regole di validazione
    $( "#form_test" ).validate({
        rules: {
            'test_input': {
                required: true
            }
        },
        message: {
            'test_input': {
                required: true
            }
        },
        errorElement:'div',
        errorPlacement: function(error, element) {
            error.insertAfter(element);
    }

});
});