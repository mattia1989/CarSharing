function validaForm() {

    var insertEmail = document.getElementById(['recupera_psw_input']);

    if (insertEmail.value == '') {
        document.getElementById(['recupero_error_label']).value = "Indirizzo email non valido";
        return false;
    } else {
        alert(insertEmail);
        return true;
    }
     return false;

}
