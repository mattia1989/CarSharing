/**
 * Created by Mattia Di Luca on 04/02/2016.
 */

// Quando il documento è pronto per essere letto:

$(document).ready(function () {

    $('#login_form').validate({

        // controllo che i campi rispettino le regole

        rules: {

            'email_utente': {
                required: true,
                email: true,
                minlength: 2
            },

            'password_utente': {
                required: true,
                minlength: 8
            },
        },

        // e, nel caso printo gli eventuali messaggi d'errore

        message: {
            'email_utente':
            {
                required: 'Inserire una email valida',
                minleght: 'Indirizzo inserito troppo corto'
            },

            'password_utente': {
                required: 'Password non inserita',
                minlength: 'Passoword troppo corta'
            },
        },

        // che vengono inseriti subito dopo l'elemento a cui si riferiscono

        errorElement: 'div',
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
    });
});
