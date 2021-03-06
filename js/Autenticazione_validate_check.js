// Quando il documento è pronto per essere letto:
$(document).ready(function () {

    $('#login_form').validate({
        debug : true,
        // controllo che i campi rispettino le regole
        rules: {

            'email': {
                required: true,
                email: true,
                minlength: 10
            },

            'password': {
                required: true,
                minlength: 4
            },
        },
        // che vengono inseriti subito dopo l'elemento a cui si riferiscono
        submitHandler: function (form) {
            form.submit()
        }
    });
});
