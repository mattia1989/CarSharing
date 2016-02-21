$().ready( function() {

    $('#login_form').validate({
        rules: {
            'email': {
                required: true,
                minlength: 5
            },
            'password': {
                required: true,
                minlength: 8
            }
        },
        messages: {
            'email': {
                required: "Inserire l'email",
                minlength: "Email troppo corta"
            },
            'password': {
                required: "Inserire la password",
                minlength: "Password troppo corta"
            }
        }
    });
});
