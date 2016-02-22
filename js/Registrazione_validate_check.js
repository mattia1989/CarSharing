// Quando il documento è pronto per essere letto:
$(document).ready(function () {

    $('#registration_form').validate({
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

            'ripeti_password': {
                minlength: 4,
                required: true,
                equalTo: "#password"
            },

            'nome': {
                required: true,
                minlength: 5
            },

            'nDocumento': {
                required: true,
                minlegth:5
            },

            'normative': {
                required: true
            }
        },
        // che vengono inseriti subito dopo l'elemento a cui si riferiscono
        submitHandler: function (form) {
            form.submit()
        }
    });
});
