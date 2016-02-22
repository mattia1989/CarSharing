// Quando il documento è pronto per essere letto:
$(document).ready(function () {

    $('#aggiungimezzo_form').validate({
        debug : true,
        // controllo che i campi rispettino le regole
        rules: {

            'targa': {
                required: true,
                minlength: 7
            },

            'modello': {
                required: true,
                minlength: 4,
                maxlength: 25
            },

            'cilindrata': {
                minlength: 3,
                maxlength: 4,
                required: true
            },

            'carburante': {
                minlength: 3,
                required: true
            },

            'km': {
                required: true
            },

            'colore': {
                required: true,
                minlength: 4
            },

            'prezzo_giornaliero': {
                required: true,
                minlength: 2,
                maxlength: 3
            },

            'immagine': {
                required: true
            }

        },
        // che vengono inseriti subito dopo l'elemento a cui si riferiscono
        submitHandler: function (form) {
            form.submit()
        }
    });
});
